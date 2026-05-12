<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\User $model */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>

<?php if ($model->scenario === 'create'): ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
<?php else: ?>
    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
<?php endif; ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>