<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PolicypackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ajax_url = yii\helpers\Url::to(['ajax-view']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

$this->registerJs("
$('div.policypack-index').on('click','tr',function(){
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
        $('#policypack-detail').html(data);
}
});
});
");

 $this->title = Yii::t('app', 'Policy Pack List');
 $this->params['breadcrumbs'][] = $this->title;
?>
<div class="policypack-index">

    <p>
        <?= Html::a(Yii::t('app', 'Company List'), ['company/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Policy List'), ['policy/index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Policy Pack'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <h1><?=  Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'ps_id',
            'package',
            //'logo:raw',
            //'created',
            //'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div id="policypack-detail">
    <?php echo $this->render('_view', ['model'=>$policypack]); ?>
</div>
