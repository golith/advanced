<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PolicyProc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="policy-proc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proc_step')->textInput() ?>

    <?= $form->field($model, 'proc_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'policy_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
