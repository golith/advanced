<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use backend\models\Policy;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Viewing Policy'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$name = $model->title;
$this->title = Yii::t('app', 'Update Policy: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
Yii::app()->clientScript->registerCoreScript('jquery');


?>
<div class="my-form">
    <?php if (!$model->isNewRecord) {
        $items = Policy::find()->where(
            ['policy_id' => $model->policy_id])->orderBy('policy_id')->all();

        if (!empty($items)) {
            foreach ($items as $item) { ?>
                <p class="text-items">
                    <label for="item<?= $item->policy_id ?>">Item<span
                            class="items-number"><?= $item->policy_id ?></span></label>
                    <input class="" form-control" type="text" name="items[]" value=<?= $item->title ?>"
                    id="item<?= $item->policy_id ?>" /><br/>
                    <a href="#" class="remove-items">Remove</a>
                </p>
            <?php }
        } else { ?>
            <p class="text-items">
                <label for="item">Item<span class="items-number">1</span></label>
                <input class="form-control" type="text" name="items[]" value="" id="item"/><br/>
                <a href="#" class="remove-items">Remove</a>
            </p>
        <?php }
    } else {
        ?>
        <p class="text-items">
            <label for="item">Item<span class="items-number">1</span></label>
            <input class="form-control" type="text" name="items[]" value="" id="item"/><br/>
            <a href="#" class="remove-items">Remove</a>
        </p>
    <?php } ?>
    <?= Html::button('Add more', ['class' => 'glyph glyphicon-plus btn btn-lg add-items']) ?>
</div>