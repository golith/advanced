<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Policypack */

$this->title = $model->ps_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policypacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policypack-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ps_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ps_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ps_id',
            'package',
            'created',
            'updated',
        ],
    ]) ?>

</div>
