<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<?php
    if(Yii::$app->session->hasFlash('success'))
    {
        echo Yii::$app->session->getFlash('success');
    }
?>

<div style="background-color: lightblue; padding:5%; padding-top:2%; padding-bottom:3%;">
    <h3 class="text-center"><b>Please fill out User Details :</b></h3>
    <br/>
    <?php $form = ActiveForm::begin(['options' => ['id' => 'Stud', 'enctype' => 'multipart/form-data']]); ?>

    <div style="display:flex; align-items:center;">
        <?= $form -> field($model, 'first_name')->textInput(['style'=>'width:500px']); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= $form -> field($model, 'last_name')->textInput(['style'=>'width:500px']); ?>
    </div>
        
    <div style="display:flex; align-items:center;">
        <?= $form -> field($model, 'email')->textInput(['style'=>'width:500px']); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= $form -> field($model, 'college_name')->textInput(['style'=>'width:500px']); ?>
    </div>
    
    <div style="display:flex; align-items:center;">
        <?= $form -> field($model, 'branch')->textInput(['style'=>'width:500px']); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= $form -> field($model, 'mobile_no')->textInput(['style'=>'width:500px']); ?>
    </div>
    
    <div style="display:flex; align-items:center;">
        <?= $form -> field($model, 'password')->passwordInput(['style'=>'width:500px']); ?> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;            
        <?= $form -> field($model, 'confirm_password')->passwordInput(['style'=>'width:500px']); ?>
    </div>
    
    <div class="text-center mt-md-1">
        <?= Html::submitButton($model->isNewRecord ? 'Submit': 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
    
         
     
    
    
