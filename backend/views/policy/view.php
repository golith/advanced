<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use backend\models\Policyread;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Viewing Policy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$name = $model->title;
$this->title = Yii::t('app', 'Update Policy: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
?>
<div class="policy-view">

    <p>
        <?= Html::a(Yii::t('app', 'Company List'), ['company/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Package List'), ['policypack/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <p>
        <?= Html::a(Yii::t('app', 'Create Policy'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'View all Policies'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Update Policy'), ['update', 'id' => $model->policy_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete Policy'), ['delete', 'id' => $model->policy_id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this Policy?'),
                    'method' => 'post',
                ],
            ]) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //check if user has read policy and if not then show button
    $uid = Yii::$app->user->id;
    $pid = $model->policy_id;
    $package = $model->ps_id;

    if (Policyread::isRead($uid, $package, $pid) == false) { ?>
        <?php // HTML::hiddenInput('user_id', Yii::$app->user->id); ?>
        <?php // HTML::hiddenInput('policy_id', $model->policy_id); ?>
        <?php // HTML::hiddenInput('ps_id', $model->ps_id);


        $form = ActiveForm::begin();
        //echo Html::activeHiddenInput($modelPoItem, "[{$i}]id");?>
        <?= Html::submitButton(Yii::t('app', 'I have Read this Policy'),
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you understand this Policy?'),
                    'method' => 'post',
                    'user_id' => $uid,
                    'id' => $model->policy_id,
                    'ps_id' => $model->ps_id
                ]
            ]
        );

        ActiveForm::end(); ?>
    <?php } ?>

    <?= DetailView::widget(['model' => $model,
        'attributes' => [
            //'policy_id',
            //'ps_id',
            //'policypack.package.',
            [
                'attribute' => 'logo',
                'value' => function ($model) {
                    return $model->getLogoHtml();
                },
                'format' => 'raw',
            ],
            'title',
            'aim',
            'policy:ntext',
            'proc:ntext',
            // 'created',
            //'updated',

        ],
    ])
    ?>

</div>
