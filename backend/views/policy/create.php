<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = Yii::t('app', 'Create Policy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policy List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-create">

    <p>
        <?= Html::a(Yii::t('app', 'Company List'), ['company/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Package List'), ['policypack/index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Policy List'), ['policy/index'], ['class' => 'btn btn-danger']) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
