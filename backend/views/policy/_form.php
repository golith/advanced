<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Policy;
use backend\models\Policypack;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="policy-form">

    <?php $form = ActiveForm::begin(['options' =>
        [
            'enctype' => 'multipart/form-data',
            'id' => 'procedure-form',
        ]
    ]);
    ?>
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

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Procedure Steps</h4></div>
            <div class="panel-body">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 50, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class must be the same as the form change if you need 2 or more dynamic forms
                    'deleteButton' => '.remove-item', // css class must be the same as the form change if you need 2 or more dynamic forms
                    'model' => $modelsProcItem[0],
                    'formId' => 'procedure-form',
                    'formFields' => [
                        'proc_step',
                        'proc_text',
                    ],
                ]); ?>

                <div class="container-items"><!-- widgetContainer -->
                    <?php foreach ($modelsProcItem as $i => $modelProcItem): ?>
                        <div class="item panel panel-default"><!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Po Item</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (! $modelProcItem->isNewRecord) {
                                    echo Html::activeHiddenInput($modelProcItem, "[{$i}]id");
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelProcItem, "[{$i}]proc_step")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelProcItem, "[{$i}]proc_text")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div><!-- .row -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php DynamicFormWidget::end(); ?>
            </div>
        </div>
    </div>
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