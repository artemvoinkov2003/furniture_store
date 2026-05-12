<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
?>

<div class="form-container">
    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'fieldConfig' => [
            'template' => "{label}\n<div class='input-wrapper'>{input}\n<span class='validation-icon'></span></div>\n{error}",
        ],
    ]) ?> 
    
    <?= $form->field($model, 'username', [
        'inputOptions' => [
            'class' => 'form-field',
            'data-validation' => 'username',
            'autocomplete' => 'off'
        ]
    ])->textInput() ?>
    
    <?= $form->field($model, 'email', [
        'inputOptions' => [
            'class' => 'form-field',
            'type' => 'email',
            'autocomplete' => 'off'
        ]
    ]) ?>
    
    <div class="input-wrapper">
        <?= $form->field($model, 'password')->passwordInput([
            'class' => 'form-field',
            'id' => 'register-password',
            'autocomplete' => 'new-password'
        ]) ?>
        <div class="password-toggle"></div>
    </div>

    <div class="password-hint">
        <div class="hint-bar"></div>
        <span class="hint-text"></span>
    </div>

    <?= $form->field($model, 'first_name', [
        'inputOptions' => ['class' => 'form-field']
    ]) ?>
    
    <?= $form->field($model, 'last_name', [
        'inputOptions' => ['class' => 'form-field']
    ]) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
        'mask' => '+7.999.999-99-99',
        'options' => [
            'class' => 'form-field',
            'autocomplete' => 'off'
        ]
    ]) ?>
    
    <?= Html::submitButton('Зарегистрироваться', ['class' => 'auth-btn']) ?>
    <?php ActiveForm::end() ?>
</div>