<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Products extends ActiveRecord
{
    public $imageFile;

    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->imageFile && $this->validate()) {
            $fileName = 'uploads/' . uniqid() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($fileName);
            $this->image = $fileName;
            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Цена',
            'image' => 'Изображение',
            'imageFile' => 'Загрузить изображение',
        ];
    }
}