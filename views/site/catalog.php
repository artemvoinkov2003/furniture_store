<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="category-goods">
    <div class="filters">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'id' => 'filter-form',
            'enableClientValidation' => false,
            'options' => ['class' => 'filter-container']
        ]) ?>
        
        <div class="filter-group">
            <?= $form->field($searchModel, 'material')->dropDownList([
                'wood' => 'Дерево',
                'metal' => 'Металл',
                'fabric' => 'Ткань'
            ], [
                'prompt' => 'Выберите материал',
                'class' => 'form-control'
            ]) ?>
        </div>

        <div class="filter-group">
            <?= $form->field($searchModel, 'size')->dropDownList([
                'small' => 'Маленький',
                'medium' => 'Средний',
                'large' => 'Большой'
            ], [
                'prompt' => 'Выберите размер',
             'class' => 'form-control'
            ]) ?>
        </div>

        <div class="filter-group price-filter">
            <label>Цена, руб:</label>
            <div id="price-slider"></div>
            <div class="price-labels">
                <span id="price-min"><?= number_format($searchModel->min_price ?? 0, 0, '', ' ') ?></span> - 
                <span id="price-max"><?= number_format($searchModel->max_price ?? 20000, 0, '', ' ') ?></span>
            </div>
            <?= $form->field($searchModel, 'min_price')->hiddenInput(['id' => 'min-price'])->label(false) ?>
            <?= $form->field($searchModel, 'max_price')->hiddenInput(['id' => 'max-price'])->label(false) ?>
        </div>

        <button type="submit" class="btn-filter" id="apply-filters">Применить фильтры</button>
        <?php ActiveForm::end() ?>
    </div>

    <div class="container-catalog">
        <div class="catalog">
            <?php foreach ($items as $item): ?>
            <div class="goods"
                data-category="<?= Html::encode($item->category) ?>"
                data-material="<?= Html::encode($item->material) ?>"
                data-size="<?= Html::encode($item->size) ?>">
                
                <div class="photo-mebel">
                    <?= Html::img($item->image, ['alt' => 'мебель']) ?>
                </div>
                
                <div class="content-wrapper">
                    <div class="furniture-description">
                        <h1><?= Html::encode($item->name)?></h1>
                        <p><?= Html::encode($item->description)?></p>
                    </div>
                    
                    <div class="price-section">
                        <div class="price"><?= number_format($item->price, 0, '', ' ') ?> ₽</div>
                        <?= Html::a('Добавить в корзину', ['/site/add-to-cart', 'id' => $item->id], [
                            'class' => 'button-catalog'
                        ]) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="zagolovok">
    <h1>Категории</h1>
</div>

<div class="category-container">

    <?php 
    $categories = [
        'comod' => 'Комод',
        'wardrobe' => 'Шкаф',
        'stul' => 'Стул',
        'table' => 'Стол',
        'bed' => 'Кровать',
        'sofa' => 'Диван'
    ];
    
    foreach ($categories as $img => $name): ?>
    <div class="kategorii">
        <div class="kategorii-inner">
            <div class="img-container">
                <?= Html::img("@web/img/{$img}.jpg", [
                    'alt' => $name,
                    'class' => 'image image-main'
                ]) ?>                
            </div>
            <div class="category-label"><?= $name ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>



