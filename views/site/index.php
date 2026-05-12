<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Главная';

?>

<div class="banner">
    <h1>Добро пожаловать на наш магазин мебели!</h1>
    <p class="lead">Твое пространство — наша забота!</p>
</div>


<div class="promo-slider">
    <div class="slide active">
        <?= Html::img('@web/img/slider1.jpg', ['alt' => 'Новинки мебели']) ?>
        <div class="slide-text">
            <h2>Черная пятница</h2>
            <p>До 50% на весь каталог</p>
        </div>
    </div>
    <div class="slide">
        <?= Html::img('@web/img/slider2.jpg', ['alt' => 'Распродажа']) ?>
        <div class="slide-text">            
            <h2>Новая коллекция 2025!</h2>
            <p>Скидка 20% на диваны и кресла</p>
        </div>
    </div>
    <div class="slide">
        <?= Html::img('@web/img/slider3.jpg', ['alt' => 'Сезонные скидки']) ?>
        <div class="slide-text">
            <h2>Акция</h2>
            <p>Скидка на все диваны 8%</p>
        </div>
    </div>
    <button class="slider-prev">‹</button>
    <button class="slider-next">›</button>
</div>


<div class="centered-container">
    <div class="zagolovok">
        <h1>Популярные категории</h1>
    </div>
</div>

<div class="popular">
    <?= Html::a(
        '<div class="popular-category">
            <div class="image-category">
                '.Html::img('@web/img/pouf.jpg', ['alt' => 'Пуфы']).'
            </div>
            <div class="blackout">
                <h1>Пуфы</h1>
            </div>
        </div>', 
        ['site/pouf'], 
        ['class' => 'category-link']
    ) ?>

    <?= Html::a(
        '<div class="popular-category">
            <div class="image-category">
                '.Html::img('@web/img/armchairs.webp', ['alt' => 'Кресла']).'
            </div>
            <div class="blackout">
                <h1>Кресла</h1>
            </div>
        </div>', 
        ['site/chair'], 
        ['class' => 'category-link']
    ) ?>

    <?= Html::a(
        '<div class="popular-category">
            <div class="image-category">
                '.Html::img('@web/img/rack.webp', ['alt' => 'Стеллаж']).'
            </div>
            <div class="blackout">
                <h1>Стеллаж</h1>
            </div>
        </div>', 
        ['site/shelving'], 
        ['class' => 'category-link']
    ) ?>
</div>


<div class="centered-container">
    <div class="zagolovok">
        <h1>Идеи для интерьера</h1>
    </div>
</div>


<div class="zagolovok-interior">
    <h1>Интерьеры комнат</h1>
</div>

<div class="rooms">

    <div class="comnata">
        <?= Html::img('@web/img/living room.jpg', ['alt' => 'Гостинная']) ?>
        <div class="interior-ideas">
            <div class="interior-card">
                <h1>Современная Гостиная</h1>
                <div class="interior"></div>
            </div>
            <div class="text-rooms">
                <h1>Эта гостиная сочетает в себе минимализм и уют. Используйте нейтральные цвета и мягкие текстуры.</h1>
            </div>
        </div>
    </div>

    <div class="comnata">
        <?= Html::img('@web/img/bedroom.jpeg', ['alt' => 'Спальня']) ?>
        <div class="interior-ideas">
            <div class="interior-card">
                <h1>Уютная Спальня</h1>
                <div class="interior"></div>
            </div>
            <div class="text-rooms">
                <h1>Создайте спокойную атмосферу с помощью пастельных тонов и натуральных материалов.</h1>
            </div>
        </div>
    </div>

    <div class="comnata">
        <?= Html::img('@web/img/kitchen.png', ['alt' => 'Кухня']) ?>
        <div class="interior-ideas">
            <div class="interior-card">
                <h1>Функциональная Кухня</h1>
                <div class="interior"></div>
            </div>
            <div class="text-rooms">
                <h1>Организуйте пространство с умом, используя современные решения для хранения и удобные рабочие поверхности.</h1>
            </div>
        </div>
    </div>

</div>

<div class="zagolovok-stili">
    <h1>Стили интерьеров</h1>
</div>

<div class="styles">

    <div class="stili">
        <?= Html::img('@web/img/minimalism.jpg', ['alt' => 'Минимализм']) ?>
        <div class="interior-ideas">
            <div class="interior-card">
                <h1>Минимализм</h1>
                <div class="interior"></div>
            </div>
            <div class="text-rooms">
                <h1>Создайте спокойное пространство с минимальным количеством предметов мебели.</h1>
            </div>
        </div>
    </div>

    <div class="stili">
        <?= Html::img('@web/img/art-deco.jpg', ['alt' => 'Ар-деко']) ?>
        <div class="interior-ideas">
            <div class="interior-card">
                <h1>Ар-деко</h1>
                <div class="interior"></div>
            </div>
            <div class="text-rooms">
                <h1>Стиль дизайна, в котором сочетаются гламурная показная роскошь, яркость цветов и этнические мотивы.</h1>
            </div>
        </div>
    </div>

    <div class="stili">
        <?= Html::img('@web/img/hai-tek.jpg', ['alt' => 'Хай-тек']) ?>
        <div class="interior-ideas">
            <div class="interior-card">
                <h1>Хай-тек</h1>
                <div class="interior"></div>
            </div>
            <div class="text-rooms">
                <h1>Использование стекла, иногда зеркального, металла или пластика, ровные глянцевые поверхности</h1>
            </div>

        </div>
    </div>

</div>



