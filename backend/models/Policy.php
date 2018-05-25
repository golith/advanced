<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "policy".
 *
 * @property string $policy_id
 * @property string $title
 * @property string $text
 * @property string $created
 * @property string $updated
 * @property string $ps_id
 *
 * @property PolicyPack $ps
 */
class Policy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'policy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'created', 'updated', 'ps_id'], 'required'],
            [['text'], 'string'],
            [['created', 'updated'], 'safe'],
            [['ps_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['ps_id'], 'exist', 'skipOnError' => true, 'targetClass' => PolicyPack::className(), 'targetAttribute' => ['ps_id' => 'ps_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'policy_id' => Yii::t('app', 'Policy ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'ps_id' => Yii::t('app', 'Ps ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPs()
    {
        return $this->hasOne(PolicyPack::className(), ['ps_id' => 'ps_id']);
    }
}
