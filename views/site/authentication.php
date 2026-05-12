<?php
use yii\helpers\Html;
?>

<div class="authentication-page">
    <div class="auth-switcher">
        <?= Html::a('Вход', ['/site/authentication', 'mode' => 'login'], [
            'class' => 'auth-tab' . (($mode ?? 'login') == 'login' ? ' active' : '')
        ]) ?>
        <?= Html::a('Регистрация', ['/site/authentication', 'mode' => 'register'], [
            'class' => 'auth-tab' . (($mode ?? 'login') == 'register' ? ' active' : '')
        ]) ?>
    </div>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <div class="auth-content-wrapper">
        <?= $content ?? 'Выберите режим' ?>
    </div>

    <div class="auth-footer">
        <p>
            <?= ($mode ?? 'login') == 'login' 
                ? 'Нет аккаунта? ' . Html::a('Зарегистрироваться', ['/site/authentication', 'mode' => 'register'])
                : 'Уже есть аккаунт? ' . Html::a('Войти', ['/site/authentication', 'mode' => 'login'])
            ?>
        </p>
    </div>
</div>
