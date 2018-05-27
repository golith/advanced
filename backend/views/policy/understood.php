<?php

//do a db update

//updateUserPolicyRead($user_id, $policy_id, $package_id);
    $model = $this->findModel($id);
    $model->user_id = $this->$user_id;
    $model->policy_id = $policy_id;
    $model->ps_id = '1';
    $model->read_date = Date ('Y-m-d H:i:s');
    $model->save();
    return $this->redirect(['site/index', 'id' => Yii::$app->user->id]);