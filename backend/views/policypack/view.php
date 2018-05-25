<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Policypack */

$this->title = $model->package;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policypacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policypack-view">



    <p>
        <?= Html::a(Yii::t('app', 'Create a Policy Pack'),
            ['create'],
            ['class' => 'btn btn-success'])
        ?>

        <?= Html::a(Yii::t('app', 'View all Policy Packs'),
            ['index'],
            ['class' => 'btn btn-warning'])
        ?>

        <?= Html::a(Yii::t('app', 'Update this Policy Pack'),
            ['update', 'id' => $model->ps_id],
            ['class' => 'btn btn-primary'])
        ?>

        <?= Html::a(Yii::t('app', 'Delete this Policy Pack'),
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ps_id',
            'package',
            //'created',
            //'updated',
        ],
    ]) ?>

</div>
