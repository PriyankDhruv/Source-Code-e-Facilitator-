<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\EventGenerator;

/* @var $this yii\web\View */
/* @var $model app\models\EventRegistration */
/* @var $form ActiveForm */


$this->title = 'Event Registration';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    
    echo Yii::$app->session->getFlash('success');
    

?>

<div class = "regform" style="background-color: lightblue; padding:5%; padding-top:2%; padding-bottom:3%;">

    <?php $form = ActiveForm::begin() ?>
        <script type = "text/javascript">
            
            window.onload =function myfun(){
            
                var getNoe = prompt("In how may events, you want to participate ?\n1, 2 or 3");
                
                if(getNoe == "1")
                {
                    document.getElementById("eventregistration-event1").style = "display:show";
                    document.getElementById("e1").style = "display:show";
                    document.getElementById("Pay").style = "display:show";
                    $("label[for='eventregistration-event2']").hide();
                    $("label[for='eventregistration-event3']").hide();
                    
                    }
                    
                if(getNoe == "2")
                {
                    document.getElementById("eventregistration-event1").style = "display:show";
                    document.getElementById("e1").style = "display:show";
                    document.getElementById("Pay").style = "display:show";
                    
                    document.getElementById("eventregistration-event2").style = "display:show";
                    document.getElementById("e2").style = "display:show";
                    document.getElementById("Pay").style = "display:show";
                    $("label[for='eventregistration-event3']").hide();
                }
                
                if(getNoe == "3")
                {
                    document.getElementById("eventregistration-event1").style = "display:show";
                    document.getElementById("e1").style = "display:show";
                    
                    document.getElementById("eventregistration-event2").style = "display:show";
                    document.getElementById("e2").style = "display:show";
                    
                    document.getElementById("eventregistration-event3").style = "display:show";
                    document.getElementById("e3").style = "display:show";
                    
                    document.getElementById("Pay").style = "display:show";
                }
                
                document.getElementById("e1").onclick = function(){
                    
                    var x = document.getElementById("eventregistration-event1").value;
                    
                    var link = "http://localhost/basic/web/index.php?r=event-generator%2Fview&id=";
                    var str = link.concat(String(x));
                    window.open(str);
                    
                }
                
                document.getElementById("e2").onclick = function(){
                    
                    var x = document.getElementById("eventregistration-event2").value;
                    
                    var link = "http://localhost/basic/web/index.php?r=event-generator%2Fview&id=";
                    var str = link.concat(String(x));
                    window.open(str);
                    
                }
                
                document.getElementById("e3").onclick = function(){
                    
                    var x = document.getElementById("eventregistration-event3").value;
                    
                    var link = "http://localhost/basic/web/index.php?r=event-generator%2Fview&id=";
                    var str = link.concat(String(x));
                    window.open(str);
                    
                }
                
            }
                 
        </script>
    
        <div style="display:flex; align-items:center;">
            <?= $form->field($model, 'event1')->dropDownList(ArrayHelper::map(EventGenerator::find()->all(), 'event_id', 'event_name'), 
                [
                    'style' => 'width:400px; display:none !important',
                    'prompt' => 'Select', 
                    'options' => [$model->event1 => ['Selected'=>'selected']]

                ]
            ) ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::submitButton('View&nbsp;&nbsp;<i class="glyphicon glyphicon-eye-open"></i>', ['id' => 'e1', 'class' => 'btn btn-primary', 'style'=>'display:none']) ?>
        </div>
        
        <div style="display:flex; align-items:center;">
            <?= $form->field($model, 'event2')->dropDownList(ArrayHelper::map(EventGenerator::find()->all(), 'event_id', 'event_name'), 
                [
                    'style' => 'width:400px; display:none !important',
                    'prompt' => 'Select', 
                    'options' => [$model->event1 => ['Selected'=>'selected']]

                ]
            ) ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::submitButton('View&nbsp;&nbsp;<i class="glyphicon glyphicon-eye-open"></i>', ['id' => 'e2', 'class' => 'btn btn-primary', 'style'=>'display:none']) ?>
        </div>
    
        <div style="display:flex; align-items:center;">
            <?= $form->field($model, 'event3')->dropDownList(ArrayHelper::map(EventGenerator::find()->all(), 'event_id', 'event_name'), 
                [
                    'style' => 'width:400px; display:none !important',
                    'prompt' => 'Select', 
                    'options' => [$model->event1 => ['Selected'=>'selected']]

                ]
            ) ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?= Html::submitButton('View&nbsp;&nbsp;<i class="glyphicon glyphicon-eye-open"></i>', ['id' => 'e3', 'class' => 'btn btn-primary', 'style'=>'display:none']) ?>
        </div>
        
        <div>
            <?= Html::submitButton('Make Payment', ['id' => 'Pay','class' => 'btn btn-success', 'style'=> 'display:none']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- eventRegistration -->