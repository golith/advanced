<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Policy;
use backend\models\Policyread;

//$this->registerJs("
//$('div.policytrainer-index').on('click','tr',function(){
//var id =$(this).data('key');
//$.ajax({
//'type' : 'GET',
//'url' : '$ajax_url',
//'dataType' : 'html',
//'data' : {
//        '$csrf_param' : '$csrf_token',
//        'id' : id
//},
//'success' : function(data){
//        $('#policytrainer-detail').html(data);
//}
//});
//});
//");


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PolicyreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$msg = Yii::$app->user->identity->username . 's\' up to date policies';

$this->title = Yii::t('app', $msg );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policytrainer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a(Yii::t('app', 'Create Policy Read'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'pr_id',
            //'user_id',
            //'user.username',

            'policypack.package',
            'policy.title',
            'read_date',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete} '],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<div id="policytrainer-detail">
    <?php // echo $this->render('_view', ['model' => $policyread]); ?>
</div>
