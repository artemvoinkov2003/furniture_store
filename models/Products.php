<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property string $image
 * @property string|null $created_at
 *
 * @property Category $category0
 */
class Products extends \yii\db\ActiveRecord
{

     public $material; 
    public $size;

    public $is_new;

    public $stock;

    public $category_id;

    public $article;
    public $dimensions;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    public function getQuestions()
{
    return $this->hasMany(ProductQuestion::class, ['product_id' => 'id']);
}

    public function getFavoritesCount()
{
    return $this->hasMany(Favorite::class, ['product_id' => 'id'])->count();
}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 3],

            [['material', 'size', 'price'], 'required'],
            ['price', 'integer', 'min' => 0, 'max' => 100000],
            [['material', 'size'], 'safe'],

            [['is_new'], 'boolean'],
            [['stock'], 'integer', 'min' => 0],

            [['category_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'material' => 'Материал',
            'size' => 'Размер',
            'price' => 'Цена',
        ];
    }
}
