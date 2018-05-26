<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "company".
 *
 * @property string $company_id
 * @property string $company_name
 * @property string $company_url
 * @property string $description
 * @property string $status
 * @property string $created
 * @property string $updated
 * @property string $file
 *
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;

    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['description', 'status'], 'string'],

            [['company_name', 'company_url', 'logo',
                'description', 'status', 'company_id',
                'created', 'updated'], 'safe'],

            [['logo', 'company_name', 'company_url'], 'string', 'max' => 255],

            [['company_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => Yii::t('app', 'Company'),
            'file' => Yii::t('app', 'Company Logo'),
            'company_name' => Yii::t('app', 'Company Name'),
            'company_url' => Yii::t('app', 'Company Url'),
            'description' => Yii::t('app', 'Company Description'),
            'status' => Yii::t('app', 'Company Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getLogoHtml()
    {
        return Html::img($this->logo);
    }
}
