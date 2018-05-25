<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

?>

    <!--<h2> < ? = Html::encode($model->created_on . ' : ' . $model->employee_id) ?></h2>-->

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'company_id',
        'company_name',
        'company_http',
        'company_url:url',
        'currency.currency_code',
        'address_format_id',
        'mailing_address_id',
        'billing_address_id',
        'country.country_name',
        'status',
        'created_on',
        'updated_on',
    ],
])
?>