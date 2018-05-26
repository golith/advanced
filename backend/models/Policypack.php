<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "policypack".
 *
 * @property string $ps_id
 * @property string $package
 * @property string $created
 * @property string $updated
 * @property string $file
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

    public $file;

    public function rules()
    {
        return [
            [['package'], 'required'],
            [['logo', 'created', 'updated'], 'safe'],
            [['logo', 'package'], 'string', 'max' => 255],
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
            'file' => Yii::t('app', 'Package Logo'),
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

    public function getLogoHtml()
    {
        return Html::img($this->logo);
    }

}
