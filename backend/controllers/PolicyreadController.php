<?php

namespace backend\controllers;

use backend\models\Policy;
use Yii;
use backend\models\Policyread;
use backend\models\PolicyreadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PolicyreadController implements the CRUD actions for Policyread model.
 */
class PolicyreadController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Policyread models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PolicyreadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $policyread = new Policyread;

        //return $this->render('index', [
        return $this->render('training', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'policyread' => $policyread,
        ]);
    }

    /**
     * Displays a single Policyread model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Creates a new Policyread model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Policyread();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->read_date = Date('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['view', 'id' => $model->pr_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Policyread model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->pr_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Policyread model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    /************************
    /** CUSTOM CONTROLLERS **
    /***********************/

    public function actionTraining($id)
    {
        $policyread = new Policyread;

        return $this->render('_training', [
            'model' => $this->findModel($id),
            'policyread' => $policyread,
        ]);
    }

    public function actionUnread($id)
    {
        $model = $this->findModel($id);

        $searchModel = new PolicyreadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $policyread = new Policyread;

        return $this->render('unread', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'policyread' => $policyread,
        ]);
    }

    public function isUnreadCount($id)
    {
        $policyCount = Policy::find()
            ->count();

        if ($policyCount > 0) {

            return $policyCount;

        }

        return 0;

    }

    public function toRead($id)
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

    /**
     * Finds the Policyread model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Policyread the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Policyread::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionLists($id)
    {
        $countDepartments = Department::find()
            ->where(['company_id' => $id])
            ->andWhere(['branch_id' => $id])
            ->count();

        $departments = Department::find()
            ->where(['company_id' => $id])
            ->andFilterWhere(['branch_id' => $id])
            ->all();

        if ($countDepartments > 0) {
            foreach ($departments as $department) {
                echo "<option value='" . $department->department_id . "'>" . $department->department_name . "</option>";
            }
        } else {
            echo "<option>There are no Departments</option>";
        }
    }

    /**
     * *Displays a single Address model as a single AJAX response
     * @param interger $id
     * @return mixed
     */
    public function actionAjaxView($id)
    {
        return $this->renderPartial('_view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAjaxViewUnread($id)
    {
        return $this->renderPartial('_view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function getPolicies()
    {
        return $this->hasMany(Policy::className(), ['policy_id' => 'policy_id']);
    }

    public function actionUnderstood($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model = $this->findModel($id);
            $model->user_id = $this->$user_id;
            $model->policy_id = $policy_id;
            $model->ps_id = '1';
            $model->read_date = Date ('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['view', 'id' => $model->policy_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
