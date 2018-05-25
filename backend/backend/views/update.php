<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Policypack */

$this->title = Yii::t('app', 'Update Policypack: {nameAttribute}', [
    'nameAttribute' => $model->ps_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policypacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ps_id, 'url' => ['view', 'id' => $model->ps_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="policypack-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
