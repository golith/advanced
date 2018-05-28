<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PolicyProc */

$this->title = Yii::t('app', 'Create Policy Proc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policy Procs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-proc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
