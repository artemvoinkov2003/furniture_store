<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart_items".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $product_id
 * @property int $quantity
 * @property float $price
 * @property string|null $created_at
 *
 * @property Products $product
 * @property User $user
 */
class CartItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

     
    public static function tableName()
    {
        return 'cart_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity'], 'integer'],
            [['product_id', 'price'], 'required'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],

            [['quantity'], 'integer', 'min' => 1],
            [['quantity'], 'validateStock'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function validateStock($attribute, $params)
    {
        if ($this->quantity > $this->product->stock) {
            $this->addError($attribute, 'Превышено доступное количество');
        }
    }

    public static function getUserCartTotal($userId)
{
    return self::find()
        ->joinWith('product')
        ->where(['user_id' => $userId])
        ->sum('cart_items.quantity * product.price');
}
}
