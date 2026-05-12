<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Products $model */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => 0.01]) ?>
<?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>