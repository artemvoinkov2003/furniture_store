<?php

namespace app\models;

use yii\base\Model;

class CreateReview extends Model
{
    public $description;
    public $image;

    public function rules()
    {
        return[
           [['user_id', 'description'], 'required'],
           ['user_id', 'integer'],
            ['image', 'file', 'extensions' => 'png,jpg', 'skipOnEmpty' => True, 'size' => 1024*1024*2],
        ];
    }

    public function publish(){
        if (!$this->validate()){
            return False;
        }

        $review = new Reviews();
        $review->user_id = \Yii::$app->user->id;
        $review->description = $this->description;
        $review->photo = $this->image;
        $review->save();

    }
}