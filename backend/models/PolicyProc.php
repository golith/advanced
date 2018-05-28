<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "policy_proc".
 *
 * @property string $id
 * @property int $proc_step
 * @property string $proc_text
 * @property string $policy_id
 *
 * @property Policy $policy
 */
class PolicyProc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policy_proc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proc_step', 'proc_text'], 'required'],
            [['proc_step', 'policy_id'], 'integer'],
            [['proc_text'], 'string'],
            [['policy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Policy::className(), 'targetAttribute' => ['policy_id' => 'policy_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'proc_step' => Yii::t('app', 'Procedure Step'),
            'proc_text' => Yii::t('app', 'Procedure Text'),
            'policy_id' => Yii::t('app', 'Policy ID'),
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
