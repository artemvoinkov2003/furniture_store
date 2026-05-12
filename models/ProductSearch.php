<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

class ProductSearch extends Model
{
    public $material;
    public $size;
    public $min_price;
    public $max_price;
    public $category;
    public $is_new;

    public function rules()
    {
        return [
            [['category', 'material', 'size'], 'string'],
            [['min_price', 'max_price'], 'number', 'min' => 0],
            [['is_new'], 'boolean'],
            [['material', 'size', 'category', 'is_new'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Products::find();

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            return new ActiveDataProvider(['query' => $query, 'pagination' => false]);
        }

        $this->min_price = $this->min_price ?? 0;
        $this->max_price = $this->max_price ?? 100000;

        $query->andFilterWhere(['>=', 'price', $this->min_price])
          ->andFilterWhere(['<=', 'price', $this->max_price]);

        $query->andFilterWhere(['category' => $this->category])
          ->andFilterWhere(['material' => $this->material])
          ->andFilterWhere(['size' => $this->size])
          ->andFilterWhere(['is_new' => $this->is_new]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
    }
}