<?php
namespace app\models;

use Yii;

class Order extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%order}}';
    }

    public function rules()
    {
        return [
             [['delivery_address', 'delivery_date', 'phone'], 'required'],
             [['delivery_address', 'delivery_method', 'delivery_date', 'phone'], 'safe'],
            [['delivery_comment', 'status'], 'string'],
            [['delivery_method'], 'default', 'value' => 'delivery'],    
            [['status'], 'default', 'value' => 'new'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'delivery_address' => 'Адрес доставки',
            'delivery_date' => 'Дата доставки',
            'delivery_comment' => 'Комментарий',
            'phone' => 'Телефон',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}