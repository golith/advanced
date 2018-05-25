<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = Yii::t('app', 'Update Policy: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    //'url' => ['view', 'id' => $model->policy_id]
    ];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update Policy');
?>
<div class="policy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
