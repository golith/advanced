<?php

use yii\helpers\Html;
use backend\models\Policyread;

/* @var $this yii\web\View */

$this->title = 'Console';
$user_id = Yii::$app->user->identity->getId();
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome <?= Yii::$app->user->identity->username; ?><br/>to the<br/> IT System Design <br/>Console!</h1>
        <?php
        if (Yii::$app->user->getIsGuest()){
            ?>
            <p class="lead">Please Login
                <!--            <a href="--><?php //echo Yii::$app->createAbsoluteUrl('site/login');
                ?><!--">Login</a>-->
                to use the current resources.
            </p>
        <?php } else { ?>
        <br/> Framework <?= Yii::powered() ?>
        <br/> Using : <?= Html::encode(Yii::$app->name) ?>
        <br/> version : <?= Yii::$app->version ?>
        <br/> Your I.P is :<?= Yii::$app->getRequest()->getUserIP(); ?>
         <?php if (Policyread::isUnread($user_id) === true) { ?>

         <br/> You have a new Unread Policy to attend to
        <br/> <?php echo Html::a(Yii::t('app', 'Read Now'), ['policyread/unread', 'id' => $user_id],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ]);
        }
        ?>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <h1>Your Tools</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Training</h2>
                <?= Html::a(Yii::t('app', 'Completed Policies'), ['policyread/index'],
                    [
                        'class' => 'btn btn-success btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?php if (Policyread::isUnread($user_id) === true) {
                    echo Html::a(Yii::t('app', 'Unread Policies'), ['policyread/index'],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ]);
                }
                ?>
                <?= Html::a(Yii::t('app', 'New Policies'), ['policyread/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= Html::a(Yii::t('app', 'Old Policies'), ['policyread/index'],
                    [
                        'class' => 'btn btn-warning btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= Html::a(Yii::t('app', 'Policy List'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= Html::a(Yii::t('app', 'Create Policies'), ['policy/create'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= Html::a(Yii::t('app', 'Delete Policies'), ['policy/index'],
                    [
                        'class' => 'btn btn-default btn-lg',
                        'target' => '_blank'
                    ])
                ?>

            </div>
        </div>
    </div>
    <?php } ?>
</div>