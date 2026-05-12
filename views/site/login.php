<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="form-container">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'action' => Url::to(['/site/login']),
        'fieldConfig' => [
            'template' => "{label}\n<div class='input-wrapper'>{input}\n<span class='validation-icon'></span></div>\n{error}",
        ],
    ]) ?>
    
    <?= $form->field($model, 'username')->textInput([
        'class' => 'form-field',
        'autocomplete' => 'off'
    ]) ?>
    
    
    <?= $form->field($model, 'password')->passwordInput([
        'class' => 'form-field',
        'autocomplete' => 'off',
        'id' => 'login-password'
    ]) ?>
    
    <div class="password-toggle"></div>
    
    <?= $form->field($model, 'rememberMe')->checkbox([
        'class' => 'remember-me-checkbox',
        'label' => 'Запомнить меня',
    ]) ?>
    
    <?= Html::submitButton('Войти', ['class' => 'auth-btn']) ?>
    <?php ActiveForm::end() ?>
</div>