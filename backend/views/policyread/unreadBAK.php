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


function getPolicy($id)
{
    if (Policy::getPolicyCount() > 0) {
        return Policy::getPolicyCount();
    }
}

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unread Policies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="policyread-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php //$toberead = toRead($user_id); ?>
<?php

    // Give total policy count
    echo 'There are ' . Policy::getPolicyCount() . ' Polcies.<br/>';

    // show array of policy ID's
    $policies = Policy::getPoliciesID();

    // list all policies by title
    $policytitle = Policyread::getPolicyIDandTitle();

//    echo print_r($policies) . '<br/>';

    foreach ($policytitle as $pt) {
        $a_button_id = $pt['policy_id'];
        $a_button_title = $pt['title'];
        echo Html::a(Yii::t('app', $a_button_title), ['policy/view', 'id' => $a_button_id],
            [
                'class' => 'btn btn-success btn-lg',
                'target' => '_blank',
            ]);
        echo '<br/><br/>';
    }
    echo '<br/> ';
     //Give total count by user
    echo 'User <strong>' . Yii::$app->user->identity->username . '</strong>' .
        ' has read ' . Policyread::getPolicyreadByUserCount($user_id) . '<br/>';


    // show array of policy ID's
    $policiesreadarray = Policyread::getPoliciesID();
    //echo print_r($policiesreadarray) . '<br/>';

    // list the policies read by user
    $titlePolicy = Policyread::getPolicyIDandTitleReadByUserID($user_id);
    foreach ($titlePolicy as $tp) {
        echo $tp['policy_id'] . ' ' . $tp['title'] . '<br/>';
    }

    echo '<br/> ';

    // Give total count by user
    echo 'User <strong>' . Yii::$app->user->identity->username . '</strong>' .
        ' needs to read ' . Policyread::getPolicyUnreadByUserCount($user_id) . '<br/>';

    $ur = Policyread::getPolicyIDUnreadByUserID($user_id);
    // list the policies not read by user by policy_id
    foreach ($ur as $urp) {
        $pid = $urp['policy_id'] . '<br/>';
        echo Html::a(Yii::t('app', $pid), ['policy/view', 'id' => $pid],
            [
                'class' => 'btn btn-success btn-lg',
                'target' => '_blank'
            ]);
        echo '<br/><br/>';
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
