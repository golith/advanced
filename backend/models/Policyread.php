<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "policyread".
 *
 * @property string $pr_id
 * @property int $user_id
 * @property string $policy_id
 * @property string $read_date
 *
 * @property Policy $policy
 */
class Policyread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'policyread';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'policy_id'], 'required'],

            [['user_id', 'policy_id', 'read_date'], 'safe'],

            [['policy_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Policy::className(),
                'targetAttribute' => ['policy_id' => 'policy_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pr_id' => Yii::t('app', 'Pr ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'policy_id' => Yii::t('app', 'Policy Name'),
            'read_date' => Yii::t('app', 'Date Attended'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolicy()
    {
        return $this->hasOne(Policy::className(), ['policy_id' => 'policy_id']);
    }
}
