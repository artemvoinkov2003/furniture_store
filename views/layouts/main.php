<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerCssFile('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<header>
    <div class="logo">
        <?= Html::img('@web/img/logotyp.png', ['alt' => '#']) ?>
    </div>
    
<?php

NavBar::begin([]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Каталог', 'url' => ['/site/catalog']],
        ['label' => 'О нас', 'url' => ['/site/about']],
        ['label' => 'Идеи', 'url' => ['/site/ideas']],
        ['label' => 'Корзина', 'url' => ['/site/basket']],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
        
        Yii::$app->user->isGuest
            ? ['label' => 'Аутентификация', 'url' => ['/site/authentication']]
            : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link']
                )
                . Html::endForm()
                . '</li>',
        
        Yii::$app->user->can('accessAdminPanel') 
            ? ['label' => 'Админ-панель', 'url' => ['/admin/products/index']]
            : ''
    ],
]);
NavBar::end();
?>
    <div class="search-container">
        <input type="text" placeholder="Поиск" class="search-input">
        <button class="search-button">Найти</button>
    </div>
</header>

<main >

        <?= $content ?>

</main>


<footer class="footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3 class="footer-title">Аккаунт</h3>
            <ul class="footer-list-left">
                    <li><a href="<?= Url::to('/site/index')?>" class="footer-link">Главная</a></li>
                    <li><a href="<?= Url::to('/site/catalog')?>" class="footer-link">Каталог</a></li>
                    <li><a href="<?= Url::to('/site/about')?>" class="footer-link">О нас</a></li>
                    <li><a href="<?= Url::to('/site/ideas')?>" class="footer-link">Идеи и вдохновение</a></li>
                </ul>
        </div>

        <div class="footer-column">
            <h3 class="footer-title">Меню</h3>
            <div class="footer-links-grid">
                <ul class="footer-list-right">
                    <li><a href="<?= Url::to('/site/basket')?>" class="footer-link">Корзина</a></li>
                    <li><a href="<?= Url::to('/site/contact')?>" class="footer-link">Контакты</a></li>
                    <li><a href="<?= Url::to('/site/authentication')?>" class="footer-link">Аутентификация</a></li>
                </ul>                
            </div>
        </div>

        <div class="footer-column social-column">
            <h3 class="footer-title">Соцсети</h3>
            <div class="social-links">
                <a href="https://vk.com/" class="social-icon">
                    <?= Html::img('@web/img/vk.png', ['alt' => 'VK']) ?>
                </a>
                <a href="https://web.telegram.org/" class="social-icon">
                    <?= Html::img('@web/img/telegram.png', ['alt' => 'Telegram']) ?>
                </a>
                <a href="https://github.com/" class="social-icon">
                    <?= Html::img('@web/img/github.png', ['alt' => 'GitHub']) ?>
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="copyright">&copy; <?= date('Y') ?> Воинков Артём. Интернет-магазин мебели InteriorPro</p>
    </div>
</footer>

<div id="scrollToTop" class="scroll-to-top">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
        <path d="M12 2l-8 8h5v10h6V10h5z" fill="currentColor"/>
    </svg>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
