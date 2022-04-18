<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login" style="background-color: lightblue; padding:5%; padding-top:2%; padding-bottom:3%;">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    
        <?= $form->field($model, 'role')->dropDownList(
            ['a' => 'Admin', 'b' => 'Student'], ['prompt'=>'Select']
        ); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
    
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11" align="left">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button', 
                'style' => 'width:120px']) ?>
            </div>  
        </div>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11" align="left">
                <a href = "http://localhost/basic/web/index.php?r=site/studform">New User? click here</a> 
            </div>        
        </div> 
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11" align="left">
                <a href = "http://localhost/basic/web/index.php?r=site/orgform">New Admin? click here</a> 
            </div>           
        </div>
    
    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        
        <br/><br/>
    </div>
</div>
