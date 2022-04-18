<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\StudForm;
use app\models\OrgForm;
use app\models\Visitor;
use app\models\Verify;
use app\models\EventGenerator;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'send-otp', 'verify'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['send-otp','verify'],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'send-otp' => ['post']
                ]
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $modelX = new EventGenerator();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', ['model' => $model,]);
    }
    
    public function actionSendOtp()
    {
        $phone = \Yii::$app->request->post('phone');
        \Yii::$app->response->format = 'json';
        $response = [];
        
        if ($phone) {
            $user = \app\models\Visitor::findByPhone($phone);
            $otp = rand(100000, 999999); // a random 6 digit number
            if ($user == null) {
                $user = new \app\models\Visitor();
                $user->phone = $phone;
                $user->created_on = time();
            }
            $user->otp = "$otp";
            $user->otp_expire = time() + 600; // To expire otp after 10 minutes
            if (!$user->save()) {
                $errorString = implode(", ", \yii\helpers\ArrayHelper::getColumn($user->errors, 0, false)); // Model's Errors string
                $response = [
                    'success' => false,
                    'msg' => $errorString
                ];
            } else {
                $msg = 'One Time Passowrd(OTP) is ' . $otp;
                
                $sid = \Yii::$app->params['twilioSid'];  //accessing the above twillio credentials saved in params.php file
                $token = \Yii::$app->params['twiliotoken'];
                $twilioNumber = \Yii::$app->params['twilioNumber'];
                
                try{
                    $client = new \Twilio\Rest\Client($sid, $token);
                    $client->messages->create($phone, [
                        'from' => $twilioNumber,
                        'body' => (string) $msg
                    ]);
                    $response = [
                        'success' => true,
                        'msg' => 'OTP Sent and valid for 10 minutes.'
                    ];
                }catch(\Exception $e){
                    $response = [
                                'success' => false,
                                'msg' => $e->getMessage()
                    ];
                }
            }
        } else {
            $response = [
                'success' => false,
                'msg' => 'Phone number is empty.'
            ];
        }
        return $response;       
    }
    
    public function actionVerify()
    {    
        if (! Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }
        
        $model = new Verify();
        if (\Yii::$app->request->isAjax)
        {
            \Yii::$app->response->format = 'json';
            $model->load(Yii::$app->request->post());
            if ($model->login()) 
            {
                $response = [
                    'success' => true,
                    'msg' => 'OTP Verified Successfully'
                ];
            } else {
                $error = implode(", ", \yii\helpers\ArrayHelper::getColumn($model->errors, 0, false)); // Model's Errors string
                $response = [
                    'success' => false,
                    'msg' => $error
                ];
            }
            return $response;
        }
        
        $model->password = '';
        return $this->render('verify', [ 'model' => $model ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', ['model' => $model]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    
    public function actionStudform()
    {
        //$modelX = new LoginForm();
        $model = new StudForm();
        //$this->login();
        $connection = new \yii\db\connection([
            'dsn' => 'mysql:host=localhost;dbname=e-facilitator',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',

            // Schema cache options (for production environment)
            //'enableSchemaCache' => true,
            //'schemaCacheDuration' => 60,
            //'schemaCache' => 'cache',
        ]);
        
        if($model->load(Yii::$app->request->post()) && $model->validate()) 
        {    
            $connection->open();
            
            return $connection->createCommand()->insert('user_details',
                        ['email' => $model->email, 
                            'first_name' => $model->first_name, 
                            'last_name' => $model->last_name,
                            'password' => $model->password, 
                            'college_name' => $model->college_name, 
                            'branch' => $model->branch,
                            'mobile_no' => $model->mobile_no,])->execute();
              
        }
        
        return $this->render('studform', ['model' => $model]);             
    }
    
    public function actionSubmit()
    {
        $model = new LoginForm();
        return $this->render('login', ['model' => $model]);
    }
    
   public function actionOrgform()
    {
        $model = new OrgForm();
        $connection = new \yii\db\connection([
            'dsn' => 'mysql:host=localhost;dbname=e-facilitator',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',

            // Schema cache options (for production environment)
            //'enableSchemaCache' => true,
            //'schemaCacheDuration' => 60,
            //'schemaCache' => 'cache',
        ]);
        
        if($model->load(Yii::$app->request->post()) && $model->validate()) 
        {    
            $connection->open();
            
            return $connection->createCommand()->insert('organizer_details',
                        ['email' => $model->email, 
                            'name_of_organizer' => $model->name_of_organizer, 
                            'name_of_institute' => $model->name_of_institute,
                            'department' => $model->department,
                            'mobile_no' => $model->mobile_no,
                            'password' => $model->password,])->execute();
        }
        
        return $this->render('orgForm', ['model' => $model]);             
    }
}
