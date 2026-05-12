<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::cssFile('@web/modules/admin/assets/css/admin.css') ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="admin-navbar">
    <?= Html::a('Товары', ['/admin/products'], ['class' => 'nav-btn']) ?>
    <?= Html::a('Пользователи', ['/admin/user'], ['class' => 'nav-btn']) ?>
</div>

<div class="admin-container">
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>