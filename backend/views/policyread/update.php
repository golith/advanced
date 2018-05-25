<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Policyread */

$this->title = Yii::t('app', 'Update Policyread: {nameAttribute}', [
    'nameAttribute' => $model->pr_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policyreads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pr_id, 'url' => ['view', 'id' => $model->pr_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="policyread-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
