<?php
use yii\helpers\Html;
?>

<table class="specs-table">
    <tr><th>Артикул</th><td><?= $product->article ?? 'PF-2256' ?></td></tr>
    <tr><th>Материал</th><td><?= $product->material ?? 'МДФ + сталь' ?></td></tr>
    <tr><th>Каркас</th><td>МДФ + сталь</td></tr>
    <tr><th>Наполнитель</th><td>ППУ высокой плотности</td></tr>
    <tr><th>Вес</th><td>8.5 кг</td></tr>
</table>