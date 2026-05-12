<?php
use yii\helpers\Html;
?>


<div class="tab-content <?= $activeTab === 'description' ? 'active' : '' ?>" id="description">
    <?= $this->render('_description', [
        'product' => $product,
        'model' => $model,
        'reviews' => $reviews
    ]) ?>
</div>


<div class="tab-content <?= $activeTab === 'specs' ? 'active' : '' ?>" id="specs">
    <?= $this->render('_specs', ['product' => $product]) ?>
</div>

<div class="tab-content <?= $activeTab === 'feedback' ? 'active' : '' ?>" id="feedback">
    <?= $this->render('_qa', [
        'product' => $product,
        'model' => $model 
    ]) ?>
</div>

<div class="tab-content <?= $activeTab === 'shipping' ? 'active' : '' ?>" id="shipping">
    <?= $this->render('_shipping') ?>
</div>


<div class="tab-content <?= $activeTab === 'related' ? 'active' : '' ?>" id="related">
    <?= $this->render('_related', ['products' => $relatedProducts]) ?>
</div>

<div class="tab-content <?= $activeTab === 'warranty' ? 'active' : '' ?>" id="warranty">
    <?= $this->render('_warranty') ?>
</div>

<div class="tab-content <?= $activeTab === 'care' ? 'active' : '' ?>" id="care">
    <?= $this->render('_care') ?>
</div>

<div class="tab-content <?= $activeTab === 'compare' ? 'active' : '' ?>" id="compare">
    <?= $this->render('_compare', ['comparisonData' => $comparisonData]) ?>
</div>