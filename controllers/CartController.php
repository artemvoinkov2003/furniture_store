<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Products;
use app\models\CartItems;

class CartController extends Controller
{
    /**
     * Добавление товара в корзину
     */
    public function actionAdd($id)
    {
        // Поиск товара в базе данных
        $product = Products::findOne($id);

        // Если товар не найден
        if (!$product) {
            Yii::$app->session->setFlash('error', 'Товар не найден.');
            return $this->redirect(['/site/catalog']);
        }

        // Проверка наличия товара на складе
        if ($product->stock < 1) {
            Yii::$app->session->setFlash('warning', 'Товар закончился.');
            return $this->redirect(['/site/catalog']);
        }

        // Логика для авторизованных пользователей
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;

            // Поиск товара в корзине пользователя
            $cartItem = CartItems::findOne([
                'user_id' => $userId,
                'product_id' => $id
            ]);

            if ($cartItem) {
                $cartItem->quantity += 1;
            } else {
                $cartItem = new CartItems([
                    'user_id' => $userId,
                    'product_id' => $id,
                    'quantity' => 1,
                    'price' => $product->price
                ]);
            }

            // Сохранение в БД
            if ($cartItem->save()) {
                // Уменьшаем остаток на складе
                $product->stock -= 1;
                $product->save();
                Yii::$app->session->setFlash('success', 'Товар добавлен в корзину.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при добавлении товара.');
            }

        } 
        // Логика для гостей (сессии)
        else {
            $cart = Yii::$app->session->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;
            } else {
                $cart[$id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1
                ];
            }

            // Сохраняем в сессию и уменьшаем остаток
            Yii::$app->session->set('cart', $cart);
            $product->stock -= 1;
            $product->save();
            Yii::$app->session->setFlash('success', 'Товар добавлен в корзину.');
        }

        // Перенаправляем в корзину
        return $this->redirect(['/site/basket']);
    }

    /**
     * Удаление товара из корзины
     */
    public function actionRemove($id)
    {
        // Для авторизованных пользователей
        if (!Yii::$app->user->isGuest) {
            $cartItem = CartItems::findOne([
                'user_id' => Yii::$app->user->id,
                'product_id' => $id
            ]);

            if ($cartItem) {
                // Возвращаем остаток на склад
                $product = Products::findOne($id);
                $product->stock += $cartItem->quantity;
                $product->save();
                
                $cartItem->delete();
            }
        } 
        // Для гостей
        else {
            $cart = Yii::$app->session->get('cart', []);
            if (isset($cart[$id])) {
                // Возвращаем остаток
                $product = Products::findOne($id);
                $product->stock += $cart[$id]['quantity'];
                $product->save();

                unset($cart[$id]);
                Yii::$app->session->set('cart', $cart);
            }
        }

        Yii::$app->session->setFlash('success', 'Товар удален из корзины.');
        return $this->redirect(['/site/basket']);
    }

    /**
     * Очистка корзины
     */
    public function actionClear()
    {
        // Для авторизованных
        if (!Yii::$app->user->isGuest) {
            CartItems::deleteAll(['user_id' => Yii::$app->user->id]);
        } 
        // Для гостей
        else {
            Yii::$app->session->remove('cart');
        }

        Yii::$app->session->setFlash('success', 'Корзина очищена.');
        return $this->redirect(['/site/basket']);
    }
}