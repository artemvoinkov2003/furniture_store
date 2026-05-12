<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="related-products">
    <h2>Сопутствующие товары</h2>
    <div class="products-grid">
        <?php foreach ($relatedProducts as $product): ?>
            <a href="<?= Url::to(['site/pouf', 'id' => $product->id]) ?>" class="product-card">
                <?= Html::img("@web/{$product->image}", ['alt' => $product->name]) ?>
                <h3><?= $product->name ?></h3>
                <div class="price"><?= Yii::$app->formatter->asDecimal($product->price, 0) ?> ₽</div>
            </a>
        <?php endforeach; ?>
    </div>
</div>