<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; 

$this->title = 'Контакты';

?>

<div class="forma">
    <h1>Оставить отзыв</h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    
    <div class="form-group">
        <label>Рейтинг:</label>
        <div class="rating-stars">
            <?php for ($i = 5; $i >= 1; $i--): ?>
                <input type="radio" id="star<?= $i ?>" name="ContactForm[rating]" value="<?= $i ?>" required>
                <label for="star<?= $i ?>">★</label>
            <?php endfor; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'button-otzov']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<div class="reviews-section">
    <h2>Последние отзывы (<?= isset($reviews) ? count($reviews) : 0 ?>)</h2>
    <div class="container-review">
        <div class="card-reviews">
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="reviews">
                        <?php if (!empty($review->photo)): ?>
                        <div class="reviews-photo">
                            <?= Html::img($review->photo, ['alt' => 'Photo']) ?>
                        </div>
                        <?php else: ?>
                        <div class="reviews-photo">
                            <?= Html::img(Url::to(['img/logo-standart.webp']), ['alt' => 'Photo']) ?>
                        </div>
                        <?php endif; ?>
                        <div class="reviews-opisanie">
                            <h1><?= Html::encode($review->user->first_name) ?>  <?= Html::encode($review->user->last_name) ?></h1>
                            
                            
                            <div class="review-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?= $i <= $review->rating ? 'active' : '' ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            
                            <h2 class="reviews-description">
                                <?= Html::encode($review->text) ?>
                            </h2>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Пока нет отзывов. Будьте первым!</p>
            <?php endif; ?>
        </div>
    </div>
</div>


<style>
.rating-stars {
    display: flex;
    gap: 5px;
    flex-direction: row-reverse;
    justify-content: flex-end;
}

.rating-stars input {
    display: none;
}

.rating-stars label {
    cursor: pointer;
    font-size: 32px;
    color: #ddd;
    transition: 0.3s;
}

.rating-stars input:checked ~ label,
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: #ffd700;
}

.review-rating {
    margin: 8px 0;
}

.review-rating .star {
    font-size: 24px;
    color: #ddd;
}

.review-rating .star.active {
    color: #ffd700;
}
</style>


<div class="map-section">
    <div class="zagolovok">
        <h1>Карта</h1>
    </div>
    <main class="content">
        <section class="contact-info">        
        <section class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3201.3908834688714!2d65.31962266129085!3d55.43258836163875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z0LrRg9GA0LPQsNC90YHQutC40Lkg0L_QtdC00LDQs9C-0LPQuNGH0LXRgdC60LjQuSDQutC-0LvQu9C10LTQtg!5e0!3m2!1sru!2sru!4v1731613823288!5m2!1sru!2sru" width="600" height="450" style="border:0; border-radius: 20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </iframe>
        </section>
    </main>
</div>


<div class="contacts-section">
    <div class="zagolovok">
        <h1>Контакты</h1>
    </div>


<div class="contact-information">

    <div class="blok-info">

        <div class="contact">
            <div class="icon-contact">
                <?= Html::img('@web/img/adress.png', ['alt' => '#']) ?>
            </div>
            <div class="kontakt">
                <h1>Адрес:</h1>
            </div>
            <div class="info">
                <h1>Россия, г.Курган, улица Примерная, 52</h1>
            </div>
        </div>

        <div class="contact">
            <div class="icon-contact">
                <?= Html::img('@web/img/telephone-call.png', ['alt' => '#']) ?>
            </div>
            <div class="kontakt">
                <h1>Телефоны:</h1>
            </div>
            <div class="info">
                <h1>+7 (123) 456-78-90;</h1>
                <h1>+7 (800) 555-35-35</h1>
            </div>
        </div>

        <div class="contact">
            <div class="icon-contact">
                <?= Html::img('@web/img/mail.png', ['alt' => '#']) ?>
            </div>
            <div class="kontakt">
                <h1>Почта:</h1>
            </div>
            <div class="info">
                <h1>info@mebelshop.ru</h1>
            </div>
        </div>

        <div class="contact">
            <div class="icon-contact">
                <?= Html::img('@web/img/clock.png', ['alt' => '#']) ?>
            </div>
            <div class="kontakt">
                <h1>Время работы:</h1>
            </div>
            <div class="info">
                <h1>8:20 - 23:30</h1>
            </div>
        </div>

        <div class="contact">
            <div class="icon-contact">
                <?= Html::img('@web/img/calendar.png', ['alt' => '#']) ?>
            </div>
            <div class="kontakt">
                <h1>Дни работы:</h1>
            </div>
            <div class="info">
                <h1>Понедельник-Суббота</h1>
            </div>
        </div>

    </div>


</div>

