<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Policypack */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="policypack-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'package')->textInput(['maxlength' => true]) ?>

    <?php
    $photo =  $model->logo;
    echo $photo? Html::img('@web/' . $photo) : '';
    ?>
    <?= $form->field($model, 'file')->fileInput(); ?>

    <div class="form-group">

        <?= Html::submitButton(Yii::t('app', 'Save'),
            ['class' => 'btn btn-success'])
        ?>

        <?= Html::a(Yii::t('app', 'Dont Save'),
            ['index'],
            ['class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to leave this page?'),
                    'method' => 'post',
                ],
            ])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
