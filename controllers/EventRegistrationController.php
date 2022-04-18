<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\EventRegistration;
use app\models\EventGenerator;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

class EventRegistrationController extends Controller
{
    
    public function actionIndex()
    {
       $model = new EventRegistration(); 
       $array = ['1', '2', '3'];
       if ($model->load(Yii::$app->request->post())) 
        {
            
            if ($model->validate()) 
            {
              //  Yii::$app->session->setFlash('success', "Payment done Successfully"); 
            
                return $this->refresh();
            }
          
        }
       
       
       return $this->render('regform', ['model'=>$model, 'array' => $array, ]);
    }

    public function actionView()
    {    
    
        echo "hello";//return Yii::$app->response->redirect(Url::to(['event-generator', 'id'=> 1]))
    }

}

