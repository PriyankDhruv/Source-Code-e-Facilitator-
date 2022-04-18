<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%event_generator}}".
 *
 * @property int $event_id
 * @property string $event_name
 * @property int $organizer_id
 * @property string $description
 * @property int $event_fees
 * @property int $credit
 * @property string $result_link
 *
 * @property OrganizerDetails $organizer
 * @property EventRegistration[] $eventRegistrations
 */
class EventGenerator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_generator}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_name', 'organizer_id', 'description', 'event_fees', 'credit', 'result_link'], 'required'],
            [['event_id', 'organizer_id', 'credit', 'event_fees'], 'integer'],
            [['event_name', 'description'], 'string'],
            [['result_link'], 'string', 'max' => 30],
            [['event_id'], 'unique'],
            [['organizer_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrgForm::className(), 'targetAttribute' => ['organizer_id' => 'organizer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'event_name' => 'Event Name',
            'organizer_id' => 'Organizer ID',
            'description' => 'Description',
            'event_fees' => 'Event Fees',
            'credit' => 'Credit',
            'result_link' => 'Result Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizer()
    {
        return $this->hasOne(OrganizerDetails::className(), ['organizer_id' => 'organizer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventRegistrations()
    {
        return $this->hasMany(EventRegistration::className(), ['event_id' => 'event_id']);
    }
}
