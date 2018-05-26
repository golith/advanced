<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PolicyreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJs("
$('div.policyread-index').on('click','tr',function(){
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
        $('#policyread-detail').html(data);
}
});
});
");

$this->title = Yii::t('app', 'Policyreads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policyread-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Policyread'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pr_id',
            'user_id',
            'policy_id',
            'read_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<div id="policyread-detail">
    <?php echo $this->render('_view', ['model' => $policyread]); ?>
</div>