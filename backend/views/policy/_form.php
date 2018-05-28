<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Policy;
use backend\models\Policypack;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="policy-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
    $package = ArrayHelper::map(Policypack::find()->all(), 'ps_id', 'package');
    echo $form->field($model, 'ps_id')->dropDownList($package,
        ['prompt' => 'Select Package']
    );
    ?>

    <?php
    $photo = $model->logo;
    echo $photo ? Html::img('@web/' . $photo) : '';
    ?>
    <?= $form->field($model, 'file')->fileInput(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'policy')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'proc')->textarea(['rows' => 6]) ?>

<!--    <p class="text-procStep">-->
<!--        <label for="procStep">Procedure Step <span class="procStep-number">1</span></label>-->
<!--        <input class="form-control" type="text" name="item[] " value="" id="procStep"/>-->
<!--        <a href="#" class="remove-item">Remove</a>-->
<!---->
<?php //echo Html::button('Add Step', [
//    'class' => 'glyphicon glyphicon-plus btn btn-default btn-lg add-items'])
//?>
<!--</p>-->

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