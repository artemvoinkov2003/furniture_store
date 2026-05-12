<?php

namespace app\controllers;

use app\models\CartItems;
use app\models\Products;
use app\models\RegisterForm;
use app\models\Reviews;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use app\models\ProductSearch;
use app\models\Favorite;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('authentication', [
            'content' => $this->renderPartial('login', ['model' => $model], true),
            'mode' => 'login'
        ]);
    }

    /**
     * Register action.
     *
     * @return Response|string
     */
    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->id);
                Yii::$app->user->login($user);
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка регистрации. Проверьте данные.');
            }
        }
        return $this->render('authentication', [
            'content' => $this->renderPartial('register', ['model' => $model], true),
            'mode' => 'register'
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Contact action.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('authError', 'Требуется авторизация');
            return $this->redirect(['/site/authentication']);
        }

        $model = new ContactForm();
        $reviews = Reviews::find()->orderBy(['created_at' => SORT_DESC])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $review = new Reviews();
            $review->user_id = Yii::$app->user->id;
            $review->text = $model->text;
            $review->rating = $model->rating;

            if ($model->image) {
                $model->image->saveAs('uploads/reviews/' . $model->image->baseName . '.' . $model->image->extension);
                $review->photo = 'uploads/reviews/' . $model->image->baseName . '.' . $model->image->extension;
            }

            if ($review->save()) {
                Yii::$app->session->setFlash('success', 'Отзыв сохранён');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения');
            }
        }

        return $this->render('contact', [
            'model' => $model,
            'reviews' => $reviews,
        ]);
    }

    /**
     * About action.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionChair()
    {
        return $this->render('chair');
    }

    public function actionShelving()
    {
        return $this->render('shelving');
    }
    
    public function actionPouf()
{
    $model = new Reviews();
    $reviews = Reviews::find()->with('user')->orderBy(['created_at' => SORT_DESC])->all();
    
    // Получаем продукт
    $product = Products::find()->where(['name' => 'Пуф'])->one();
    if (!$product) {
        throw new \yii\web\NotFoundHttpException('Товар "Пур" не найден.');
    }

    // Проверка избранного
    $isFavorite = !Yii::$app->user->isGuest 
        ? Favorite::isFavorite($product->id, Yii::$app->user->id) 
        : false;

    // Определяем активную вкладку
    $activeTab = Yii::$app->request->get('tab', 'description');

    // AJAX-режим: возвращаем только контент вкладок
    if (Yii::$app->request->isAjax) {
        return $this->renderPartial('_tabs', [
            'activeTab' => $activeTab,
            'product' => $product,
            'model' => $model,
            'reviews' => $reviews
        ]);
    }

     $relatedProducts = Products::find()
        ->where(['category_id' => $product->category_id])
        ->limit(4)
        ->all();

    $comparisonData = [
        'current' => $product,
        'similar' => Products::find()
            ->where(['!=', 'id', $product->id])
            ->limit(3)
            ->all()
    ];

    
    return $this->render('pouf', [
        'model' => $model,
        'reviews' => $reviews,
        'product' => $product,
        'isFavorite' => $isFavorite,
        'activeTab' => $activeTab,
        'relatedProducts' => $relatedProducts,
        'comparisonData' => $comparisonData
    ]);


}
    

    /**
     * Catalog action with filters
     *
     * @return string
     */
public function actionCatalog()
{
    $searchModel = new ProductSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->get());

    if (empty($searchModel->min_price)) $searchModel->min_price = 0;
    if (empty($searchModel->max_price)) $searchModel->max_price = 100000;

    return $this->render('catalog', [
        'searchModel' => $searchModel,
        'items' => $dataProvider->getModels(),
    ]);
}

    /**
     * Ideas action.
     *
     * @return string
     */
    public function actionIdeas()
    {
        return $this->render('ideas');
    }

    /**
     * Authentication page
     */
    public function actionAuthentication($mode = 'login')
    {
        $content = '';
        if ($mode === 'login') {
            $model = new LoginForm();
            $content = $this->renderPartial('login', ['model' => $model], true);
        } elseif ($mode === 'register') {
            $model = new RegisterForm();
            $content = $this->renderPartial('register', ['model' => $model], true);
        }

        return $this->render('authentication', [
            'content' => $content,
            'mode' => $mode
        ]);
    }

    /**
     * Basket action
     */
    public function actionBasket()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('authError', 'Требуется авторизация');
            return $this->redirect(['/site/authentication']);
        }

        $user_id = Yii::$app->user->id;
        $items = CartItems::find()
            ->where(['user_id' => $user_id])
            ->with('product')
            ->all();

        $totalPrice = 0;
        foreach ($items as $item) {
        $totalPrice += ($item->product->price ?? 0) * ($item->quantity ?? 0);
}

        return $this->render('basket', [
            'items' => $items,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Update cart action (AJAX)
     */
    public function actionUpdateCart()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            return ['success' => false, 'message' => 'Требуется авторизация'];
        }

        $itemId = Yii::$app->request->post('id');
        $action = Yii::$app->request->post('action');

        $cartItem = CartItems::findOne([
            'user_id' => Yii::$app->user->id,
            'product_id' => $itemId
        ]);

        if (!$cartItem) {
            return ['success' => false, 'message' => 'Товар не найден'];
        }

        $newQuantity = ($action === 'plus') 
            ? $cartItem->quantity + 1 
            : $cartItem->quantity - 1;

        if ($newQuantity < 1) {
            $cartItem->delete();
        } else {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        }

        $grandTotal = CartItems::find()
            ->joinWith('product')
            ->where(['user_id' => Yii::$app->user->id])
            ->sum('cart_items.quantity * products.price');

        return [
            'success' => true,
            'newQuantity' => $newQuantity > 0 ? $newQuantity : 0,
            'itemTotal' => number_format($cartItem->product->price * $newQuantity, 0, '', ' '),
            'grandTotal' => number_format($grandTotal, 0, '', ' ')
        ];
    }

    /**
     * Add to cart action
     */
    public function actionAddToCart($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/register']);
        }

        $product = Products::findOne($id);
        if (!$product) {
            throw new NotFoundHttpException('Товар не найден');
        }

        $cartItem = CartItems::findOne([
            'user_id' => Yii::$app->user->id,
            'product_id' => $id
        ]);

        if ($cartItem) {
            $cartItem->quantity += 1;
        } else {
            $cartItem = new CartItems([
                'user_id' => Yii::$app->user->id,
                'product_id' => $id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        $cartItem->save();
        return $this->redirect(['/site/basket']);
    }

    /**
     * AJAX validation
     */
    public function actionValidateForm()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new RegisterForm();
        $model->load(Yii::$app->request->post());
        return ActiveForm::validate($model);
    }

    public function actionToggleFavorite($productId)
{
    Yii::$app->response->format = Response::FORMAT_JSON;
    
    if (Yii::$app->user->isGuest) {
        return ['error' => 'Требуется авторизация'];
    }

    try {
        $result = Favorite::toggle($productId);
        $count = Favorite::getCount($productId);
        $isFavorite = Favorite::isFavorite($productId, Yii::$app->user->id);

        return [
            'success' => true,
            'count' => $count,
            'isFavorite' => $isFavorite
        ];
        
    } catch (\Exception $e) {
        Yii::error($e->getMessage());
        return ['error' => 'Ошибка сервера'];
    }
}
}