<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">



    <p>
        <?= Html::a(Yii::t('app', 'Add Company'),
            ['create'],
            ['class' => 'btn btn-success'])
        ?>
        <?= Html::a(Yii::t('app', 'Update Company'),
            ['update', 'id' => $model->company_id],
            ['class' => 'btn btn-primary'])
        ?>
        <?= Html::a(Yii::t('app', 'Delete Company'),
            ['delete', 'id' => $model->company_id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'company_id',
            //same as writing it as a function below
            //'logoHtml:raw',
            [
                'attribute' => 'logo',
                'value' => function ($model) {
                    return $model->getLogoHtml();
                },
                'format' => 'raw',
            ],
            'company_name',
            'company_url:url',
            'description:ntext',
            'status',
//            'created',
//            'updated',
        ],
    ]) ?>

</div>
