<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $text;
    public $image;

    public $rating;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 3],
            [['rating'], 'integer', 'min' => 1, 'max' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => 'Текст',
            'image' => 'Изображение'
        ];
    }
}
