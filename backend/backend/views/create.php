<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Policypack */

$this->title = Yii::t('app', 'Create Policypack');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policypacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policypack-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
