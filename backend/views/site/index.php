<?php

use yii\helpers\Html;
use backend\models\Policy;
use backend\models\Policyread;

/* @var $this yii\web\View */

$user_id = Yii::$app->user->identity->getId();
$username = Yii::$app->user->identity->username;
$titlebar = $username . 's\' Console';
$this->title = $titlebar;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome <?= $username; ?><br/>to the<br/> IT System Design <br/>Console!</h1>
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

            <br/> You have <?php
            $counter = Policyread::getPolicyUnreadByUserCount($user_id);
            //echo '<br/><h1 style="color: red;">';
            echo '<br/><h1>';
            echo Html::a(Yii::t('app', $counter), ['policyread/unread', 'id' => $user_id],
                [
                    'target' => '_blank'
                ]);

            // . $counter
            echo '</h1><br/>';
            echo 'Unread polic';
            echo ($counter > 1) ? 'ies' : 'y';
            echo ' to attend to.<br/>';
            echo Html::a(Yii::t('app', 'Read Now'), ['policyread/unread', 'id' => $user_id],
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
                <?= '&nbsp' ?>
                <?php if (Policyread::isUnread($user_id) === true) {
                    echo Html::a(Yii::t('app', 'Unread Policies'),
                        [
                            'policyread/unread', 'id' => $user_id],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ]);
                }
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'New Policies'), ['policyread/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Old Policies'), ['policyread/index'],
                    [
                        'class' => 'btn btn-warning btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Policy List'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Create Policies'), ['policy/create'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Delete Policies'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Worker Health& Safety Module</h2>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= Html::a(Yii::t('app', 'Incident Reporting'), ['policy/index'],
                        [
                            'class' => 'btn btn-success btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'SWMS Documents'), ['policy/index'],
                        [
                            'class' => 'btn btn-primary btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Manual Handling Procedures'), ['policy/create'],
                        [
                            'class' => 'btn btn-primary btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Corrective Action'), ['policy/index'],
                        [
                            'class' => 'btn btn-danger btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Chemical & Hazards'), ['policy/index'],
                        [
                            'class' => 'btn btn-danger btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                </div>
            </div>
            <?= '&nbsp' ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= Html::a(Yii::t('app', 'Electrical Register'), ['policy/index'],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Contractor Register'), ['policy/index'],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Activity Register'), ['policyread/index'],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Risk Register'), ['policyread/index'],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                    <?= '&nbsp' ?>
                    <?= Html::a(Yii::t('app', 'Training Register'), ['policy/index'],
                        [
                            'class' => 'btn btn-warning btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                </div>
            </div>
            <?= '&nbsp' ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= Html::a(Yii::t('app', 'KPI Reporting'), ['policy/index'],
                        [
                            'class' => 'btn btn-info btn-lg',
                            'target' => '_blank'
                        ])
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2>Quality Assurance</h2>
                </div>
            </div>
            <div>
                <?= Html::a(Yii::t('app', 'Quality Managment'), ['policyread/index'],
                    [
                        'class' => 'btn btn-success btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Documents & Policies'), ['policyread/index'],
                    [
                        'class' => 'btn btn-warning btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Quality Assurance Register'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Quality Assurance Reminder'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Gap Analysis'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Training & Assessment</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'Training Register'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Assessment Register'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'Training the Trainer'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Human Resources</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 1'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 2'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 3'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Inventory Manager</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 1'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 2'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 3'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Finance Manger</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Procurment (SRM)</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Production (PLM)</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Distribution (SCM)</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Corporate performance and governance</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Customer Service (CRM)</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2>Sales</h2>
            </div>
        </div>
        <div>
            <div class="col-lg-12">
                <?= Html::a(Yii::t('app', 'More shit to do 4'), ['policy/index'],
                    [
                        'class' => 'btn btn-primary btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 5'), ['policy/index'],
                    [
                        'class' => 'btn btn-info btn-lg',
                        'target' => '_blank'
                    ])
                ?>
                <?= '&nbsp' ?>
                <?= Html::a(Yii::t('app', 'More shit to do 6'), ['policy/index'],
                    [
                        'class' => 'btn btn-danger btn-lg',
                        'target' => '_blank'
                    ])
                ?>
            </div>
        </div>
        <?php } ?>
    </div>