<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Verify Your Phone No.';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="background-color: lightblue; padding:5%">
    <div class="site-login" >
        <h1>Verify Me</h1>

        <p><b>Please enter your Phone Number to become an authenticated user:</b></p>

        <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
                    'labelOptions' => [
                        'class' => 'col-lg-2 control-label'
                    ]
                ]
            ]);
        ?>

        <div id="section-1">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=> '+1234567890']) ?>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-11">
                    <?= Html::button('Send OTP',['class'=>'btn btn-primary','id'=>'request-otp-btn']); ?>
                </div>
            </div>
        </div>

        <div id="section-2" style="display:none;">
            <?= $form->field($model, 'password')->passwordInput() ?>

            <?=$form->field($model, 'rememberMe')->checkbox(['template' => 
                 "<div class=\"col-lg-offset-2 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>"
            ])?>

            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-11">
                    <?= Html::button('Login', ['class' => 'btn btn-primary', 'id' => 'login-button']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


<?php
$otpUrl = Url::toRoute(['site/send-otp']);
$loginUrl = Url::toRoute(['site/verify']);
$loginSuccessUrl = Url::toRoute('site/index');
$csrf =Yii::$app->request->csrfToken;
$script = <<< JS
    $(document).ready(function(){
        $("button#request-otp-btn").click(function() {
            sendOtp();
        });
        
        $("button#login-button").click(function() {
            login();
        }); 
        
        function sendOtp() {
            $("#login-form").yiiActiveForm('validateAttribute', 'verify-username'); 
            setTimeout(function() {
              var username = $("#verify-username");
              var phone = username.val(); 
              var isPhoneValid = ($("div.field-loginform-username.has-error").length==0);
              if(phone!='' && isPhoneValid) {
                  $.ajax({
                     url: '$otpUrl',
                     data: {phone: phone,_csrf:'$csrf'},
                     method:'POST',
                     beforeSend:function(){
                            $("button#request-otp-btn").prop('disabled',true);
                     },
                     error:function(xhr, err) {
                            alert("An error occurred, please try again");   
                     },
                     complete:function() {
                            $("button#request-otp-btn").prop('disabled',false);
                     },
                     success: function(data) {
                            if(data.success==false) {
                                alert(data.msg);
                                return false;
                            } else {
                                $("#section-1").hide();
                                $("#section-2").show();
                                alert(data.msg);
                            }
                       }
                  });
               }
            }, 200);
        }
        
        function login(){
            var form = $("#login-form") 
            form.yiiActiveForm("validateAttribute", "verify-password"); 
            setTimeout(function() {
              var otp = $("#verify-password").val();
              var isOtpValid = ($("div.field-loginform-password.has-error").length==0);
              if(otp!='' && isOtpValid) {
                  $.ajax({
                     url: '$loginUrl',
                     data:form.serialize(),
                     dataType: 'json',
                     method:'POST',
                     beforeSend:function() {
                        $("button#login-button").prop('disabled',true);
                     },
                     error:function(xhr, err) {
                        alert("An error occurred, please try again");     
                     },
                     complete:function() {
                        $("button#login-button").prop('disabled',false);
                     },
                     success: function(data) {
                            if(data.success==true) {
                                alert(data.msg);
                                window.location="$loginSuccessUrl";
                            } else {
                                alert(data.msg);
                            }
                       }
                  });
               }
            }, 200);
        }
    });
    
JS;

$position = \yii\web\View::POS_READY;
$this->registerJs($script, $position);
?>