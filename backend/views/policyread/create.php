<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Policyread */

$this->title = Yii::t('app', 'Create Policyread');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policyreads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policyread-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
