<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2><?= Html::encode($product->name) ?></h2>
<p><?= Html::encode($product->description) ?></p>

<div class="features-grid">
    <div class="feature">
        <h3>Экокожа премиум-класса</h3>
        <p>Антивандальное покрытие, устойчивое к царапинам</p>
    </div>
    <div class="feature">                
        <h3>Размеры</h3>
        <p>Ширина: 60см × Высота: 40см × Глубина: 60см</p>
    </div>
</div>

<?php $form = ActiveForm::begin(['action' => ['site/contact']]) ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 5])->label('Ваш отзыв') ?>
    <?= $form->field($model, 'rating')->input('number', ['min' => 1, 'max' => 5])->label('Оценка') ?>
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>

