<?php
namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Products;
use app\modules\admin\models\ProductsSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;


class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Редактирование товара
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            // Обновляем изображение только если загружен новый файл
            if ($model->imageFile && $model->upload()) {
                Yii::$app->session->setFlash('success', 'Изображение обновлено!');
            }
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Товар успешно изменен!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удаление товара
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        // Удаляем связанное изображение
        if ($model->image && file_exists($model->image)) {
            unlink($model->image);
        }
        
        $model->delete();
        Yii::$app->session->setFlash('success', 'Товар удален!');
        return $this->redirect(['index']);
    }

    /**
     * Поиск товара по ID
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Товар не найден.');
    }
}