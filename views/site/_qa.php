<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="qa-section">
    <h2>Вопросы и ответы</h2>
    
    <div class="question-form">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'text')->textarea(['rows' => 3])->label('Ваш вопрос') ?>
            <?= Html::submitButton('Задать вопрос', ['class' => 'btn btn-secondary']) ?>
        <?php ActiveForm::end() ?>
    </div>

    <div class="questions-list">
        <?php foreach ($product->questions as $question): ?>
            <div class="question-item">
                <div class="question"><?= Html::encode($question->text) ?></div>
                <?php if ($question->answer): ?>
                    <div class="answer">Ответ: <?= Html::encode($question->answer) ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>