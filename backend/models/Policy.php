<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "policy".
 *
 * @property string $policy_id
 * @property string $title
 * @property string $aim
 * @property string $policy
 * @property string $proc
 * @property string $created
 * @property string $updated
 * @property string $ps_id
 * @property string $file
 *
 * @property PolicyPack $ps
 */
class Policy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

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
            [['title', 'ps_id'], 'required'],

            [['policy', 'proc', 'aim'], 'string'],

            [['title', 'policy', 'ps_id', 'aim', 'logo', 'proc',

                'created', 'updated'], 'safe'],

            [['ps_id'], 'integer'],

            [['title'], 'string', 'max' => 255],

            [['ps_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => PolicyPack::className(),
                'targetAttribute' => ['ps_id' => 'ps_id']],

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
            'policy_id' => Yii::t('app', 'Policy Name'),
            'file' => Yii::t('app', 'Policy Logo'),
            'title' => Yii::t('app', 'Title'),
            'aim' => Yii::t('app', 'Aim'),
            'policy' => Yii::t('app', 'Policy'),
            'proc' => Yii::t('app', 'Procedure'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'ps_id' => Yii::t('app', 'Package'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPs()
    {
        return $this->hasOne(PolicyPack::className(), ['ps_id' => 'ps_id']);
    }

    public function getPolicyread()
    {
        return $this->hasMany(Policyread::className(), ['policy_id' => 'policy_id']);
    }

    public function getLogoHtml()
    {
        return Html::img($this->logo);
    }


    function getPolicyCount()
    {
        return Policy::find()->count();
    }

    function getPoliciesID()
    {
        return Policy::find()->select('policy_id')->asArray()->all();
    }

    function getPoliciesTitle($policy_id)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("SELECT `title` FROM `policy` WHERE `policy_id` = '$policy_id'");
        $result = $command->queryAll();
        return $result;
    }

    function getPackageID($policy_id)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("SELECT `ps_id` FROM `policy` WHERE `policy_id` = '$policy_id'");
        $result = $command->queryAll();
        return $result;
    }

    public function updateUserPolicyRead($user_id, $policy_id, $package_id)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("INSERT INTO `policyread` (`pr_id`, `user_id`, `policy_id`, `ps_id`, `read_date`) VALUES (NULL, '$user_id', '$policy_id', '$package_id', now()");
        $result = $command->queryAll();
        
        // check if successful
        if($result) {
            redirect(['site/index', 'id' => Yii::$app->user->id]);
        } else {
            $msg = 'problem updating database';
            return $msg;
        }

    }
}
