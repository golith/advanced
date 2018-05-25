<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PolicyreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Your Read Policies');
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

            'pr_id',
            //'user_id',
            //'policypack.package',
            'user.username',
            'policy.title',
            'read_date',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete} '],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<div id="unread-detail">

</div>
