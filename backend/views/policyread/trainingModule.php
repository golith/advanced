<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PolicyreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJs("
$('div.training-index').on('click','tr',function(){
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
        $('#training-detail').html(data);
}
});
});
");

$this->title = Yii::t('app', 'Training Module');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Policyread'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
<!--    --><?php //GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'pr_id',
//            'user_id',
//            'policy_id',
//            'read_date',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div id="training-detail">
    <?php echo $this->render('_view', ['model' => $policyread]); ?>
</div>