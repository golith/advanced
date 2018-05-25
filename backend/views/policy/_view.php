<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Policy */

?>

    <!--<h2> < ? = Html::encode($model->created_on . ' : ' . $model->employee_id) ?></h2>-->

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [

        //'policy_id',
        //'ps_id',
        'title',
        'aim',
        'text:ntext',
        'created',
        'updated',
    ],
])
?>