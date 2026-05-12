<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Избранное';

?>
<div class="favorites-page">
    <h1>Ваши избранные товары</h1>

    <?php if (empty($items)): ?>
        <div class="empty-favorites">
            <?= Html::img('@web/img/empty-favorites.svg', ['alt' => 'Пусто']) ?>
            <p>В избранном пока ничего нет</p>
        </div>
    <?php else: ?>
        <div class="favorites-grid">
            <?php foreach ($items as $key => $item): 
                $product = Yii::$app->user->isGuest ? $item : $item->product;
            ?>
                <div class="favorite-item">
                    <?= Html::a(
                        Html::img('@web/'.$product['image'], ['alt' => $product['name']]),
                        ['/site/product', 'id' => $product['id']]
                    ) ?>
                    <div class="item-info">
                        <h3><?= $product['name'] ?></h3>
                        <div class="price"><?= number_format($product['price'], 0, '', ' ') ?> ₽</div>
                        <?= Html::a(
                            'Удалить',
                            ['/favorites/remove', 'id' => $product['id']],
                            [
                                'class' => 'btn-remove',
                                'data' => ['method' => 'post']
                            ]
                        ) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>