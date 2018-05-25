<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "policypack".
 *
 * @property string $ps_id
 * @property string $package
 * @property string $created
 * @property string $updated
 *
 * @property Policy[] $policies
 */
class Policypack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'policypack';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package', 'created', 'updated'], 'required'],
            [['created', 'updated'], 'safe'],
            [['package'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ps_id' => Yii::t('app', 'Ps ID'),
            'package' => Yii::t('app', 'Package'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolicies()
    {
        return $this->hasMany(Policy::className(), ['ps_id' => 'ps_id']);
    }
}
