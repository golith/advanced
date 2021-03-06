<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = Yii::t('app', 'Create Company');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <p>
        <?= Html::a(Yii::t('app', 'Company List'),
            ['company/index'],
                [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to leave this page?'),
                        'method' => 'post',
                    ],
                ]
        ) ?>
        <?= Html::a(Yii::t('app', 'Package List'),
            ['policypack/index'],

                [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to leave this page?'),
                        'method' => 'post',
                    ],
                ]
        ) ?>
        <?= Html::a(Yii::t('app', 'Policy List'),
            ['policy/index'],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to leave this page?'),
                    'method' => 'post',
                ],
            ]
        ) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
