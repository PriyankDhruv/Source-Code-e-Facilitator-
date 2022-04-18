<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%event_registration}}".
 *
 * @property int $user_id
 * @property int $event1
 * @property int $event2
 * @property int $event3
 *
 * @property UserDetails $user
 * @property EventGenerator $e10
 * @property EventGenerator $e20
 * @property EventGenerator $e30
 * @property UserProfile $userProfile
 */
class EventRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_registration}}';
    }

    /**
     * {@inheritdoc}
     */
    public $event1;
    public $event2;
    public $event3;
    
    public function rules()
    {
        return [
            [['event1'], 'required'],
            [['user_id', 'event_id'], 'integer'],
            [['user_id'], 'unique'],
            [['event1', 'event2', 'event3'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            
            'event1' => 'Event 1',
            'event2' => 'Event 2',
            'event3' => 'Event 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserDetails::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getE10()
    {
        return $this->hasOne(EventGenerator::className(), ['event_id' => 'event1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getE20()
    {
        return $this->hasOne(EventGenerator::className(), ['event_id' => 'event2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getE30()
    {
        return $this->hasOne(EventGenerator::className(), ['event_id' => 'event3']);
    }
}
