<?php
use yii\helpers\Html;
?>

<div class="cart-container">
    
    <div class="payment-methods">
        <div class="method-card">
            <h2 class="section-title">Способы оплаты</h2>
            <div class="method-options">
                <label class="method-option">
                    <input type="radio" name="payment" value="card" class="visually-hidden">
                    <span class="option-content">Банковская карта</span>
                </label>
                <label class="method-option">
                    <input type="radio" name="payment" value="cash" class="visually-hidden">
                    <span class="option-content">Наличные</span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        <?php foreach ($items as $item): ?>
        <div class="cart-item-card">
            <div class="item-image">
                <?= Html::img($item->product->image, [
                    'alt' => $item->product->name,
                    'class' => 'product-img'
                ]) ?>
            </div>
            
            <div class="item-details">
                <h3 class="product-title"><?= Html::encode($item->product->name) ?></h3>
                <div class="price-block">
                    <span class="price"><?= number_format($item->product->price, 0, '', ' ') ?> ₽</span>
                </div>
                
                <div class="quantity-control">
                    <button class="qty-btn minus" data-id="<?= $item->id ?>">−</button>
                    <span class="quantity"><?= $item->quantity ?></span>
                    <button class="qty-btn plus" data-id="<?= $item->id ?>">+</button>
                </div>
                
                <div class="total-price" id="total-<?= $item->id ?>">
                    <?= number_format($item->product->price * $item->quantity, 0, '', ' ') ?> ₽
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="checkout-sidebar">
        <div class="method-card">
            <h2 class="section-title">Способы доставки</h2>
            <div class="method-options">
                <label class="method-option">
                    <input type="radio" name="delivery" value="courier" class="visually-hidden">
                    <span class="option-content">Курьером</span>
                </label>
                <label class="method-option">
                    <input type="radio" name="delivery" value="pickup" class="visually-hidden">
                    <span class="option-content">Самовывоз</span>
                </label>
            </div>
        </div>

        <div class="total-summary">
            <div class="summary-row">
                <span class="total-label">Итого:</span>
                <span class="total-amount" id="grand-total">
                    <?= number_format(array_sum(array_map(
                        fn($item) => $item->product->price * $item->quantity, 
                        $items
                    )), 0, '', ' ') ?> ₽
                </span>
            </div>            
        </div>
    </div>
</div>