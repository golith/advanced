<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ajax_url = yii\helpers\Url::to(['ajax-view']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

$this->registerJs("
$('div.company-index').on('click','tr',function(){
    var id =$(this).data('key');
        $.ajax({
            'type' : 'GET',
            'url' : '$ajax_url',
            'dataType' : 'html',
            'data' : {
                    '$csrf_param' : '$csrf_token',
                    'id' : id
                    },
                    'success' : function(data){
                            $('#company-detail').html(data);
                    }
        });
    });
");

$this->title = Yii::t('app', 'Company List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <p>
        <?= Html::a(Yii::t('app', 'Package List'), ['policypack/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Policy List'), ['policy/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'company_id',
//            [
//                'attribute' => 'logo',
//                'value' => function ($model) {
//                    return $model->getLogoHtml();
//                },
//                'format' => 'raw',
//            ],
            'company_name',
            'company_url:url',
            //'logo',
            'status',
            //'description:ntext',
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div id="company-detail">

    <?php
    echo $this->render('_view', ['model' => $company]);
    ?>

</div>

<div id="branch-detail">

    <?php
    // echo $this->render('_view', ['model' => $branch]);
    ?>

</div>
