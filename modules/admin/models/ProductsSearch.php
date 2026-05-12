<?php
namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductsSearch extends Products
{
    public function rules()
    {
        return [
            [['id', 'price'], 'number'],
            [['name', 'image'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}