<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventGenerator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-generator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'event_id')->textInput(['style'=>'width:1023px', 'disabled' => true]) ?>
    
    <div style="display:flex; align-items:center;">
        <?php echo $form->field($model, 'event_name')->textInput(['style'=>'width:500px']) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $form->field($model, 'organizer_id')->textInput(['style'=>'width:500px']) ?>
    </div>

    

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6, 'style'=>'width:1023px']) ?>
    
    <div style="display:flex; align-items:center;">
        <?php echo $form->field($model, 'event_fees')->textInput(['style'=>'width:500px']) ?>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $form->field($model, 'credit')->textInput(['style'=>'width:500px']) ?>    
    </div>
    
    

    <?= $form->field($model, 'result_link')->textInput(['maxlength' => true, 'style'=>'width:1023px']) ?>
    <div class="text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
