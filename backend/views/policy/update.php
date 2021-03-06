<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = Yii::t('app', 'Update Policy: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Policy'),
    'url' => [
        'index'
    ]];

$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    //'url' => ['view', 'id' => $model->policy_id]
];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update Policy');

?>
<div class="policy-update">

    <p>
        <?= Html::a(Yii::t('app', 'Company List'),
            ['company/index'], ['class' => 'btn btn-success'])
        ?>
        <?= Html::a(Yii::t('app', 'Package List'),
            ['policypack/index'], ['class' => 'btn btn-warning'])
        ?>
        <?= Html::a(Yii::t('app', 'Policy List'),
            ['index'], ['class' => 'btn btn-danger'])
        ?>
    </p>
    <p>
        <?= Html::a(Yii::t('app', 'Create a Policy'),
            ['create'],
            ['class' => 'btn btn-success'])
        ?>

        <?= Html::a(Yii::t('app', 'View all Policies'),
            ['index'],
            ['class' => 'btn btn-warning'])
        ?>

        <?= Html::a(Yii::t('app', 'Delete this Policy'),
            ['delete', 'id' => $model->ps_id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
        ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
