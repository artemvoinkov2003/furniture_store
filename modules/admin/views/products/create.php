<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Products $model */

$this->title = 'Добавить товар';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>