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
//        [
//            'attribute' => 'logo',
//            'value' => function ($model) {
//                return $model->getLogoHtml();
//            },
//            'format' => 'raw',
//        ],
        'pr_id',
        'user_id',
        'policy_id',
        'read_date',
    ],
])
?>