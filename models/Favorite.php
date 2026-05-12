<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Favorite extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%favorites}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            ['product_id', 'exist', 'targetClass' => Products::class, 'targetAttribute' => 'id']
        ];
    }

    public static function getCount($productId)
{
    return self::find()
        ->where(['product_id' => $productId])
        ->count();
}

public static function isFavorite($productId, $userId)
{
    return self::find()
        ->where(['product_id' => $productId, 'user_id' => $userId])
        ->exists();
}
    
    public static function toggle($productId)
    {
        $userId = Yii::$app->user->id;
        $exists = self::find()
            ->where(['user_id' => $userId, 'product_id' => $productId])
            ->exists();

        if ($exists) {
            return self::deleteAll(['user_id' => $userId, 'product_id' => $productId]);
        } else {
            $model = new self();
            $model->user_id = $userId;
            $model->product_id = $productId;
            return $model->save();
        }
    }
}