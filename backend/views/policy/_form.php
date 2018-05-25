<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Policypack;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="policy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $package = ArrayHelper::map(Policypack::find()->all(), 'ps_id', 'package');
    echo $form->field($model, 'ps_id')->dropDownList($package,
        ['prompt' => 'Select Package']
    );
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'),
            ['class' => 'btn btn-success'])
        ?>

        <?= Html::a(Yii::t('app', 'Dont Save'),
            ['index'],
            ['class' => 'btn btn-danger'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
