<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Policypack */

?>

    <!--<h2> < ? = Html::encode($model->created_on . ' : ' . $model->employee_id) ?></h2>-->

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'logo',
            'value' => function ($model) {
                return $model->getLogoHtml();
            },
            'format' => 'raw',
        ],
        //'ps_id',
        'package',
        //'created',
        //'updated',,
    ],
])
?>