<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return Yii::$app->formatter->asCurrency($model->price);
                },
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->image 
                        ? Html::img($model->image, ['width' => '100px']) 
                        : 'Нет изображения';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            ['delete', 'id' => $model->id],
                            [
                                'data' => [
                                    'confirm' => 'Удалить товар?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
            ],
        ],
    ]) ?>
</div>