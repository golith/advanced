<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Address */

?>

<!--<h2> --><?php //= Html::encode($model->created_on . ' : ' . $model->address_id) ?><!--</h2>-->

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
    ],
])
?>
