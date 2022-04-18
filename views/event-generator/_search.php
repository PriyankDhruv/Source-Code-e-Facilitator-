<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventGeneratorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-generator-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'event_id') ?>

    <?= $form->field($model, 'event_name') ?>

    <?= $form->field($model, 'organizer_id') ?>

    <?= $form->field($model, 'description') ?>
    
    <?= $form->field($model, 'event_fees') ?>

    <?= $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'result_link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
