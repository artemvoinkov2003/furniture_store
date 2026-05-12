<?php

use yii\helpers\Html; ?>

<div class="gallery">
    <div class="left-cart-gallery">
        <div class="first-card"><?= Html::img('@web/img/gallery-1.jpeg', ['alt' => 'Галерея']) ?>
        </div>
        <div class="right-cart-gallery">
            <div class="second-card "><?= Html::img('@web/img/gallery-2.jpeg', ['alt' => 'Галерея']) ?>
            </div>
            <div class="third-card"><?= Html::img('@web/img/gallery-3.jpeg', ['alt' => 'Галерея']) ?>
            </div>
        </div>
    </div>
</div>
</div>

<div class="zagolovok">
    <h1>Советы по обустройству</h1>
</div>


<div class="arrangement">
    <div class="group-sovet-top">

        <div class="advice">
            <h1>Свобода передвижения</h1>
            <p>Пространство не должно создавать препятствий ни для одного из членов семьи.</p>
        </div>

        <div class="advice">
            <h1>Отсутствие хлама</h1>
            <p>Лишние вещи, включая декор, загромождают комнату, разрушают эстетику жилья, затрудняют уборку, создают проблемы для здоровья.</p>
        </div>

        <div class="advice">
            <h1>Меры безопасности</h1>
            <p>При планировании комнат необходимо соблюдать нормы освещённости, рекомендации по ширине проёмов, углы наклона лестниц, высоту ограждающих конструкций.</p>
        </div>

        <div class="advice">
            <h1>Назначения помещения</h1>
            <p>Любое пространство, включая объединённую кухню с гостиной, должно сохранять предусмотренный функционал.</p>
        </div>

    </div>

    <div class="group-sovet-bottom">

        <div class="advice">
            <h1>Сценарии освещения</h1>
            <p>Свет необходимо подстраивать к нуждам пользователей.</p>
        </div>

        <div class="advice">
            <h1>Визуальная гармония</h1>
            <p>Жилое помещение должно восприниматься как цельная картина.</p>
        </div>

        <div class="advice">
            <h1>Приток и удаление воздуха</h1>
            <p>В помещениях со сложным режимом эксплуатации следует обеспечить достаточный воздухообмен.</p>
        </div>

        <div class="advice">
            <h1>Разводка электропитания</h1>
            <p>В каждом помещении количество розеток должно соответствовать числу стационарных бытовых приборов плюс 1–2 единицы на непредвиденные нужды.</p>
        </div>

    </div>

</div>

<div class="zagolovok">
    <h1>Блог</h1>
</div>


<div class="blog">

    <div class="post">
    <div class="post-image">
        <?= Html::img('@web/img/blog-post-1.jpg', ['alt' => 'пост']) ?>
    </div>
    <div class="post-content">
        <div class="title">
            <h1>Как выбрать идеальный диван для вашего дома</h1>
        </div>
        <div class="article">
            <h1>Советы по выбору дивана, включая размеры, формы и материалы.</h1>
        </div>
        <div class="meta">
            <div class="published">
                <h1>Опубликовано: 14 декабря 2024 года</h1>
            </div>
            <button class="read-more">Читать далее</button>                       
        </div>
    </div>
</div>

<div class="post">
    <div class="post-image">
        <?= Html::img('@web/img/blog-post-2.jpeg', ['alt' => 'пост']) ?>
    </div>
    <div class="post-content">
        <div class="title">
            <h1>Тенденции в дизайне интерьеров 2024 года</h1>
        </div>
        <div class="article">
            <h1>Обзор современных тенденций в мебельном дизайне.</h1>
        </div>
        <div class="meta">
            <div class="published">
                <h1>Опубликовано: 26 сентября 2024 года</h1>
            </div>
            <button class="read-more">Читать далее</button> 
        </div>
    </div>
</div>

<div class="post">
    <div class="post-image">
        <?= Html::img('@web/img/blog-post-3.jpg', ['alt' => 'пост']) ?>
    </div>
    <div class="post-content">
        <div class="title">
            <h1>Как ухаживать за деревянной мебелью</h1>
        </div>
        <div class="article">
            <h1>Полезные советы по уходу за различными типами мебели.</h1>
        </div>
        <div class="meta">
            <div class="published">
                <h1>Опубликовано: 9 мая 2024 года</h1>
            </div>
            <button class="read-more">Читать далее</button> 
        </div>
    </div>
</div>

<div class="post">
    <div class="post-image">
        <?= Html::img('@web/img/blog-post-4.jpg', ['alt' => 'пост']) ?>
    </div>
    <div class="post-content">
        <div class="title">
            <h1>Как создать комфортное рабочее пространство в офисе</h1>
        </div>
        <div class="article">
            <h1>Рекомендации по выбору офисной мебели для повышения продуктивности.</h1>
        </div>
        <div class="meta">
            <div class="published">
                <h1>Опубликовано: 5 июля 2024 года</h1>
            </div>
            <button class="read-more">Читать далее</button> 
        </div>
    </div>
</div>

</div>