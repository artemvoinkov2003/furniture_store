<?php
use yii\helpers\Html;
?>

<div class="comparison-table">
    <h2>Сравнение с аналогами</h2>
    <table>
        <thead>
            <tr>
                <th>Характеристика</th>
                <th>Текущая модель</th>
                <?php foreach ($comparisonData['similar'] as $product): ?>
                    <th><?= $product->name ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Цена</td>
                <td><?= $comparisonData['current']->price ?> ₽</td>
                <?php foreach ($comparisonData['similar'] as $product): ?>
                    <td><?= $product->price ?> ₽</td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>Материал</td>
                <td><?= $comparisonData['current']->material ?></td>
                <?php foreach ($comparisonData['similar'] as $product): ?>
                    <td><?= $product->material ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>