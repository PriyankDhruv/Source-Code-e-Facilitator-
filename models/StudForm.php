<?php

    namespace app\models;

    use yii\base\Model;

    class StudForm extends \yii\db\ActiveRecord
    {
        public $first_name;
        public $last_name;
        public $email;
        public $college_name;
        public $branch;
        public $mobile_no;
        public $password;
        public $confirm_password;
        
        public static function tableName()
        {
            return 'user_details';
            
        }
        
        
        public function rules()
        {
            return [
                [['first_name', 'last_name', 'email', 'mobile_no', 'password', 'confirm_password'], 'required'],
                
                ['first_name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Please enter word characters only'],
                ['first_name', 'string', 'min' => 3, 'max' => 10],
                
                ['last_name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Please enter word characters only'],
                ['last_name', 'string', 'min' => 3, 'max' => 10],
                
                ['college_name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Please enter word characters only'],
                ['college_name', 'string', 'min' => 3, 'max' => 30],
                
                ['branch', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Please enter word characters only'],
                ['branch', 'string', 'min' => 2, 'max' => 25],
                
                ['mobile_no', 'isNumeric'],
                ['mobile_no', 'string', 'length' => 10],
                
                [['confirm_password'], 'compare', 'compareAttribute' => 'password'],
            ];
        }
        
        
         /**
            * Validates if the username is numeric.
            * This method serves as the inline validation for username.
            *
            * @param string $attribute the attribute currently being validated
            * @param array $params the additional name-value pairs given in the rule
        */

        public function isNumeric($attribute, $params)
        {
            if (!is_numeric($this -> mobile_no))
                $this -> addError($attribute, Yii::t('app', '{attribute} must be numeric', ['{attribute}' => $attribute]));
        }
        
        
       
        
    }

?>