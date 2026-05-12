<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Product;
use app\models\Favorite;

class FavoritesController extends Controller
{
    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        
        if (!$product) {
            Yii::$app->session->setFlash('error', 'Товар не найден');
            return $this->redirect(Yii::$app->request->referrer);
        }

        if (Yii::$app->user->isGuest) {
            $favorites = Yii::$app->session->get('favorites', []);
            $favorites[$id] = $product->attributes;
            Yii::$app->session->set('favorites', $favorites);
        } else {
            $favorite = new Favorite([
                'user_id' => Yii::$app->user->id,
                'product_id' => $id
            ]);
            $favorite->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemove($id)
    {
        if (Yii::$app->user->isGuest) {
            $favorites = Yii::$app->session->get('favorites', []);
            unset($favorites[$id]);
            Yii::$app->session->set('favorites', $favorites);
        } else {
            Favorite::deleteAll([
                'user_id' => Yii::$app->user->id,
                'product_id' => $id
            ]);
        }

        return $this->redirect(['/favorites']);
    }

    public function actionIndex()
    {
        $items = Yii::$app->user->isGuest 
            ? Yii::$app->session->get('favorites', [])
            : Favorite::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->with('product')
                ->all();

        return $this->render('favorites', [
            'items' => $items
        ]);
    }
}