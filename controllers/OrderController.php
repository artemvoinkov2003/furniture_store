<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Order; 
use yii\helpers\Json; 

class OrderController extends Controller
{
    public function actionCreate()
{
    $order = new Order();
    
    if ($order->load(Yii::$app->request->post())) {
        if ($order->save()) {
            return $this->redirect(['/success']);
        }
    }
    
    return $this->render('error', [
        'message' => 'Ошибка при сохранении заказа'
    ]);
}

public function actionDelivery()
{
    $model = new Order();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->save()) {
            return $this->redirect(['success']);
        }
    }

    if ($model->hasErrors()) {
        return Json::encode(['errors' => $model->errors]);
    }

    return $this->render('delivery', [
        'model' => $model
    ]);
}
}

