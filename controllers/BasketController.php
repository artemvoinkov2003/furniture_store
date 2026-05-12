<?php

namespace app\controllers;

use Yii;
use app\models\CartItems;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\filters\AccessControl;

class BasketController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update-quantity'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionUpdateQuantity()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    try {
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type');

        // Проверка авторизации
        if (Yii::$app->user->isGuest) {
            Yii::$app->response->statusCode = 401;
            return ['success' => false, 'message' => 'Требуется авторизация'];
        }

        $cartItem = CartItems::find()
            ->where(['id' => $id])
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->one();

        if (!$cartItem) {
            Yii::$app->response->statusCode = 404;
            return ['success' => false, 'message' => 'Элемент не найден'];
        }

        // Обновление количества
        if ($type === 'plus') {
            $cartItem->quantity += 1;
        } elseif ($type === 'minus' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        }

        if (!$cartItem->save()) {
            throw new ServerErrorHttpException('Ошибка сохранения');
        }

        return [
            'success' => true,
            'newQuantity' => $cartItem->quantity,
            'itemTotal' => Yii::$app->formatter->asCurrency($cartItem->quantity * $cartItem->price),
            'grandTotal' => Yii::$app->formatter->asCurrency(CartItems::getUserCartTotal(Yii::$app->user->id))
        ];

    } catch (\Exception $e) {
        Yii::$app->response->statusCode = 500;
        return ['success' => false, 'message' => $e->getMessage()];
    }
}
}