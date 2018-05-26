<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
        <?= Html::a(Yii::t('app', 'Company List'), ['company/index'], ['class' => 'btn btn-success'])?>
        <?= Html::a(Yii::t('app', 'Package List'), ['policypack/index'], ['class' => 'btn btn-warning'])?>
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

    <?= DetailView::widget(['model' => $model,
        'attributes' => [
            //'policy_id',
            //'ps_id',
            [
                'attribute' => 'logo',
                'value' => function ($model) {
                    return $model->getLogoHtml();
                },
                'format' => 'raw',
            ],
            'title',
            'aim',
            'text:ntext',
           // 'created',
            //'updated',

        ],
    ])
    ?>

</div>

