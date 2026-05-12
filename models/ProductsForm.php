<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ProductsForm is the model behind the contact form.
 */
class ProductsForm extends Model
{
    public $name;
    public $price;
    public $description;
    public $image;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 3],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'price' => 'Цена',
            'description' => 'Описание',
            'image' => 'Изображение'
        ];
    }
}
