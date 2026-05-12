<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Reviews;

$this->title = 'Пуфы';

$model = $model ?? new Reviews();
$reviews = $reviews ?? [];
$product = $product ?? null;
$isFavorite = $isFavorite ?? false;
?>

<main>
    <?php if ($product): ?>
        <div class="product-gallery">
            <div class="main-image">
                <?= Html::img("@web/{$product->image}", ['alt' => $product->name, 'id' => 'mainImage']) ?>
            </div>
            <div class="thumbnails">
                <?= Html::img('@web/img/pouf.jpg', ['alt' => 'Пуф', 'class' => 'thumbnail active']) ?>
                <?= Html::img('@web/img/pouf-2.jpg', ['alt' => 'Пуф', 'class' => 'thumbnail', 'id' => 'pouf-2']) ?>
                <?= Html::img('@web/img/pouf-3.jpeg', ['alt' => 'Пуф', 'class' => 'thumbnail', 'id' => 'pouf-3']) ?>
            </div>
        </div>

        <div class="price-block">
            <div class="price">
                <span class="old-price">12 500 ₽</span>
                <span class="current-price"><?= Yii::$app->formatter->asDecimal($product->price, 0) ?> ₽</span>
            </div>

            <div class="bookmark" data-product-id="<?= $product->id ?>" data-state="<?= $isFavorite ? 'active' : 'inactive' ?>">
                <div class="ribbon"></div>
                <span class="bookmark-text">
                    <?= $isFavorite ? 'В коллекции' : 'Добавить в коллекцию' ?>
                </span>
                <span class="bookmark-counter"><?= $product->favoritesCount ?></span>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Товар временно отсутствует</div>
    <?php endif; ?>

    <!-- Обновленные кнопки -->
    <div class="product-tabs">
        <?= Html::a('Описание', 
            ['site/pouf', 'tab' => 'description'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'description' ? ' active' : ''),
                'data-tab' => 'description'
            ]
        ) ?>
        
        <?= Html::a('Характеристики', 
            ['site/pouf', 'tab' => 'specs'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'specs' ? ' active' : ''),
                'data-tab' => 'specs'
            ]
        ) ?>

        <?= Html::a('Вопросы', 
            ['site/pouf', 'tab' => 'feedback'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'feedback' ? ' active' : ''),
                'data-tab' => 'feedback'
            ]
        ) ?>

        <?= Html::a('Доставка', 
            ['site/pouf', 'tab' => 'shipping'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'shipping' ? ' active' : ''),
                'data-tab' => 'shipping'
            ]
        ) ?>

        <?= Html::a('Комплектующие', 
            ['site/pouf', 'tab' => 'related'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'related' ? ' active' : ''),
                'data-tab' => 'related'
            ]
        ) ?>

        <?= Html::a('Гарантия', 
            ['site/pouf', 'tab' => 'warranty'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'warranty' ? ' active' : ''),
                'data-tab' => 'warranty'
            ]
        ) ?>

        <?= Html::a('Уход', 
            ['site/pouf', 'tab' => 'care'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'care' ? ' active' : ''),
                'data-tab' => 'care'
            ]
        ) ?>

        <?= Html::a('Сравнение', 
            ['site/pouf', 'tab' => 'compare'], 
            [
                'class' => 'tab-btn' . ($activeTab === 'compare' ? ' active' : ''),
                'data-tab' => 'compare'
            ]
        ) ?>
    </div>

    <!-- Контейнер для контента -->
    <div id="tab-content-container">
        <?= $this->render('_tabs', [
            'activeTab' => $activeTab,
            'product' => $product,
            'model' => $model,
            'reviews' => $reviews,
            'relatedProducts' => $relatedProducts ?? [],
            'comparisonData' => $comparisonData ?? []
        ]) ?>
    </div>
</main>

