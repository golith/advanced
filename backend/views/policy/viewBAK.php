<?php

use yii\helpers\Html;
use backend\models\Policy;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Viewing Policy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$name = $model->title;
$this->title = Yii::t('app', 'Update Policy: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->registerJs(
        '$("document").ready(function(){ alert("Page Loaded"); });'
);

//$this->registerJsFile(
//    'backend\web\newBox.js',
//    [
//           // '\backend\assets\AppAsset'
//    ],
//    [
//            'position' => '\yii\web\View::POS_END'
//    ]
//);

$this->registerJsFile('newBox.js');

?>
<div class="my-form">

    <?php
    if( !$model->isNewRecord){
        $items = Policy::find()->where(['policy_id'=>$model->policy_id])->orderBy('policy_id')->all();
        if(!empty($items)){
            foreach ($items as $item) {
                ?>

                <p class="text-items">
                    <label for="item<?= $item->policy_id ?>">Item <span class="items-number"><?= $item->policy_id ?></span></label>
                    <input class="form-control" type="text" name="items[]" value="<?= $item->title ?>" id="item<?= $item->policy_id ?>" /><br>
                    <a href="#" class="remove-items">Remove</a>
                </p>
            <?php }}else{
            ?>
            <p class="text-items">
                <label for="item">Item <span class="items-number">1</span></label>
                <input class="form-control" type="text" name="items[]" value="" id="item" /><br>
                <a href="#" class="remove-items">Remove</a>
            </p>

            <?php
        } } else{?>
        <p class="text-items">
            <label for="item">Item <span class="items-number">1</span></label>
            <input class="form-control" type="text" name="items[]" value="" id="item" /><br>
            <a href="#" class="remove-items">Remove</a>
        </p>
    <?php }?>
    <?= Html::button('Add More', ['class'=>'glyphicon glyphicon-plus btn btn-default btn-sm add-items']) ?>
</div>