<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = Yii::t('app', 'Create Policy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policy List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
