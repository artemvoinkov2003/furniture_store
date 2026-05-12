<?php
namespace app\models;

use yii\db\ActiveRecord;

class ProductQuestion extends ActiveRecord 
{
    public static function tableName()
    {
        return 'questions'; 
    }

    public function rules()
    {
        return [
            [['product_id', 'text'], 'required'],
            [['answer'], 'string'],
            [['product_id'], 'integer'],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }
}

