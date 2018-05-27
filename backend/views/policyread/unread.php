<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Policy;
use backend\models\Policyread;

/* @var $this yii\web\View */
/* @var $model backend\models\Policyread */

$ajax_url = yii\helpers\Url::to(['ajax-view']);
$csrf_param = Yii::$app->request->csrfParam;
$csrf_token = Yii::$app->request->csrfToken;

$this->registerJs("
$('div.undread-view').on('click','tr',function(){
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
        $('#unread-detail').html(data);
}
});
});
");

$msg = Yii::$app->user->identity->username . 's\' policies to be attended';
$user_id = Yii::$app->user->identity->getId();
$this->title = Yii::t('app', $msg);
function toRead($id)
{

    $policyCount = Policy::find()
        ->count();

    $policies = Policy::find()
        ->select('policy_id')
        ->asArray()
        ->column();

    $policiesRead = Policyread::find()
        ->select('policy_id')
        ->asArray()
        ->where(['user_id' => $id])
        ->column();


    //iterate over the array of unread policies
    if ($policyCount > 0) {

        if (array_diff($policies, $policiesRead)) {

            return array_diff($policies, $policiesRead);

        } else {

            return false;
        }
    }
}


function getPoliciesIDbyUser($id)
{
    return Policyread::find()->select('policy_id')->where(['user_id' => $id]);
}


//function getPolicy($id)
//{
//    if (Policy::getPolicyCount() > 0) {
//        return Policy::getPolicyCount();
//    }
//}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unread Policies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="policyread-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php

    // Give total count by user
    $countP = Policyread::getPolicyUnreadByUserCount($user_id);

    echo 'User <strong>' . Yii::$app->user->identity->username . '</strong>' .
        ' needs to read ' . Policyread::getPolicyUnreadByUserCount($user_id) .
        ' polic';
    echo ($countP > 1) ? 'ies' : 'y';
    echo '<br/>';

    $ur = Policyread::getPolicyIDUnreadByUserID($user_id);
    // list the policies not read by user by policy_id
    foreach ($ur as $urp) {
        $pid = $urp['policy_id'];

        // get policy title
        $pTitle = Policy::getPoliciesTitle($pid);

        foreach($pTitle as $pt){
            $titlep = $pt['title'];
            echo Html::a(Yii::t('app', $titlep), ['policy/view', 'id' => $pid],
                [
                    'class' => 'btn btn-success btn-lg',
                    'target' => '_blank'
                ]);
            echo '<br/><br/>';
        }
    }

    echo '<br/> ';

    ?>
    <!--    --><?php //echo DetailView::widget([
    //        'model' => $model,
    //        'attributes' => [
    //            'pr_id',
    //            'user.username',
    //            'policy.title',
    //            'read_date',
    //        ],
    //    ]) ?>

</div>

<div id="unread-detail">
    <?php // echo $this->render('_viewUnread', ['model' => $policyread]); ?>
</div>
