<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CartItem extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cart_item}}';
    }
}

class Cart
{
    private $items;

    public function __construct()
    {
        $this->loadItems();
    }
    
    public static function getGrandTotal($userId)
    {
    return self::find()
        ->joinWith('product')
        ->where(['user_id' => $userId])
        ->sum('(cart.quantity * product.price)');
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    private function loadItems()
    {
        if (Yii::$app->user->isGuest) {
            $this->items = Yii::$app->session->get('cart', []);
        } else {
            $this->items = CartItem::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->indexBy('product_id')
                ->all();
        }
    }

    public function add($productId, $quantity = 1)
    {
        $product = Product::findOne($productId);
        if (!$product) {
            return false;
        }

        if (Yii::$app->user->isGuest) {
            $items = Yii::$app->session->get('cart', []);
            if (isset($items[$productId])) {
                $items[$productId]['quantity'] += $quantity;
            } else {
                $items[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }
            Yii::$app->session->set('cart', $items);
        } else {
            $item = CartItem::findOne([
                'user_id' => Yii::$app->user->id,
                'product_id' => $productId
            ]);

            if ($item) {
                $item->quantity += $quantity;
            } else {
                $item = new CartItem([
                    'user_id' => Yii::$app->user->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);
            }

            $item->save();
        }

        $this->loadItems();
        return true;
    }

    public function remove($productId)
    {
        if (Yii::$app->user->isGuest) {
            $items = Yii::$app->session->get('cart', []);
            if (isset($items[$productId])) {
                unset($items[$productId]);
                Yii::$app->session->set('cart', $items);
            }
        } else {
            CartItem::deleteAll([
                'user_id' => Yii::$app->user->id,
                'product_id' => $productId
            ]);
        }

        $this->loadItems();
    }

    public function clear()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->remove('cart');
        } else {
            CartItem::deleteAll(['user_id' => Yii::$app->user->id]);
        }

        $this->items = [];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotalQuantity()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['quantity'] ?? $item->quantity;
        }
        return $total;
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $price = $item['price'] ?? $item->price;
            $quantity = $item['quantity'] ?? $item->quantity;
            $total += $price * $quantity;
        }
        return $total;
    }
}