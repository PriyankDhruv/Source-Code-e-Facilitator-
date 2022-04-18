<?php

    namespace app\models;

    use yii\base\Model;

    class OrgForm extends \yii\db\ActiveRecord
    {
        public $name_of_organizer;
        public $name_of_institute;
        public $email;
        public $mobile_no;
        public $department;
        public $password;
        public $confirm_password;
        
        public static function tableName()
        {
            return 'organizer_details';
            
        }

        public function rules()
        {
            return [
                [['name_of_organizer', 'name_of_institute', 'email', 'mobile_no', 'password', 'confirm_password'], 'required'],
                
                ['name_of_organizer', 'match', 'pattern' => '/^[a-zA-Z\s]+$/','message' => 'Please enter word characters only'],
                ['name_of_organizer', 'string', 'min' => 3, 'max' => 10],
                
                ['name_of_institute', 'match', 'pattern' => '/^[a-zA-Z\s]+$/','message' => 'Please enter word characters only'],
                ['name_of_institute', 'string', 'min' => 3, 'max' => 10],
                
                ['department', 'match', 'pattern' => '/^[a-zA-Z\s]+$/','message' => 'Please enter word characters only'],
                ['department', 'string', 'min' => 2, 'max' => 25],
                
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