<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\db\Query;

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
            // [['user_id', 'policy_id'], 'required'],

            [['user_id', 'policy_id', 'read_date', 'ps_id'], 'safe'],

            [['policy_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Policy::className(),
                'targetAttribute' => ['policy_id' => 'policy_id']],

            [['policy_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pr_id' => Yii::t('app', 'Pr ID'),
            'ps_id' => Yii::t('app', 'Package'),
            'user_id' => Yii::t('app', 'User'),
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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPolicypack()
    {
        return $this->hasOne(Policypack::className(), ['ps_id' => 'ps_id']);
    }

    /** CUSTOM Fx's */
    public function isUnreadCount($id)
    {
        $policyCount = Policy::find()
            ->count();

        if ($policyCount > 0) {

            return $policyCount;

        }

        return 0;

    }

    public function isRead($uid, $package, $pid)
    {
//        $policiesRead = Policyread::find()
//            ->select('policy_id')
//            ->asArray()
//            ->where(['user_id' => $id])
//            ->column();

        $connection = Yii::$app->db;
        $command = $connection->createCommand(" SELECT policy_id FROM `policyread` 
 WHERE user_id = $uid
 AND ps_id = $package
 AND policy_id = $pid");
        $result = $command->queryAll();

        if ($result) {

            return true;

        }

        return false;

    }

    public function isUnread($id)
    {
        $policyCount = Policy::find()
            ->count();

        $policies = Policy::find()
            ->select('policy_id')
            ->asArray()
            ->column();

        $policiesRead = Policyread::find()
            ->select('policy_id')
            ->asArray()
            ->where(['user_id' => $id])
            ->column();

        //iterate over the array of unread policies
        if ($policyCount > 0) {

            if (array_diff($policies, $policiesRead)) {

                return true;

            }

            return false;

        }

    }


    function getPolicyreadByUserCount($user_id)
    {
        return Policyread::find()->where($user_id)->count();
    }

    function getPolicyIDandTitle()
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("
SELECT policy_id, title 
FROM `policy`");
        $result = $command->queryAll();
        return $result;
    }

    function getPoliciesID()
    {
        return Policyread::find()->select('policy_id')->asArray()->all();
    }

    function getPolicyIDandTitleReadByUserID($user_id)
    {
        $connection = Yii::$app->db;
        $command = $connection->createCommand("
            SELECT policy.policy_id, policy.title 
            FROM `policy` 
            LEFT JOIN `policyread`
            ON policy.policy_id = policyread.policy_id 
            WHERE `user_id` = $user_id");

        $result = $command->queryAll();
        return $result;
        //return Policyread::find()->where($user_id)->count();
    }

    function getPolicyIDUnreadByUserID($user_id)
    {

        // the old way
        // set up array to hold vars to be returned
        $array_result = array();

        //get all policies
        $connection = Yii::$app->db;
        $command1 = $connection->createCommand("SELECT `policy_id` FROM `policy`");
        $result1 = $command1->queryAll();

        // get all policies read by user
        $connection = Yii::$app->db;
        $command2 = $connection->createCommand(" SELECT policy_id FROM `policyread` WHERE `user_id` = $user_id");
        $result2 = $command2->queryAll();

        return array_diff_key($result1, $result2);

    }

    public function getPolicyUnreadByUserCount($user_id)
    {
        $connection = Yii::$app->db;
        $command1 = $connection->createCommand("SELECT `policy_id` FROM `policy`");
        $result1 = $command1->queryAll();

        // get all policies read by user
        $connection = Yii::$app->db;
        $command2 = $connection->createCommand(" SELECT policy_id FROM `policyread` WHERE `user_id` = $user_id");
        $result2 = $command2->queryAll();

        return count(array_diff_key($result1, $result2));


    }

    function getPolicyIDandTitleUnreadByUserID($user_id)
    {

        // the old way
        // set up array to hold vars to be returned
        $array_result = array();

        //get all policies
        $connection = Yii::$app->db;
        $command1 = $connection->createCommand("SELECT `policy_id` FROM `policy`");
        $result1 = $command1->queryAll();

        // get all policies read by user
        $connection = Yii::$app->db;
        $command2 = $connection->createCommand(" SELECT policy_id FROM `policyread` WHERE `user_id` = $user_id");
        $result2 = $command2->queryAll();

        $keys = array_diff_key($result1, $result2);

        $arr3 = array();
        foreach ($keys as $k) {
            $connection = Yii::$app->db;
            $command3 = $connection->createCommand("SELECT `policy_id, title` FROM `policy`");
            $result3 = $command3->queryAll();

            $arr3[] = $result3;
        }
        return $arr3;
    }

    public function toRead($id)
    {

        $policyCount = Policy::find()
            ->count();

        $policies = Policy::find()
            ->select('policy_id')
            ->asArray()
            ->column();

        $policiesRead = Policyread::find()
            ->select('policy_id')
            ->asArray()
            ->where(['user_id' => $id])
            ->column();

        //iterate over the array of unread policies
        if ($policyCount > 0) {

            return array_diff_key($policies, $policiesRead);

        } else {

            return false;
        }
    }
}
