<?php

namespace backend\controllers;

use Yii;
use backend\models\Policypack;
use backend\models\PolicypackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PolicypackController implements the CRUD actions for Policypack model.
 */
class PolicypackController extends Controller
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
     * Lists all Policypack models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PolicypackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $policypack = new Policypack;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'policypack' => $policypack,
        ]);
    }

    /**
     * Displays a single Policypack model.
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
     * Creates a new Policypack model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Policypack();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imageName = $model->package;

            if (UploadedFile::getInstance($model, 'file')) {

                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('uploads/policypack/' . $imageName . '.' . $model->file->extension);

                //save path to the db
                $model->logo = 'uploads/policypack/' . $imageName . '.' . $model->file->extension;
            } else {
                $model->file = 'noimage.jpg';
                $model->file->saveAs('uploads/policypack/' . $imageName . '.jpg');
            }

            $model->created = Date ('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->ps_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Policypack model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->updated = Date ('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['view', 'id' => $model->ps_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Policypack model.
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

    /**
     * Finds the Policypack model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Policypack the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Policypack::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAjaxView($id)
    {
        return $this->renderPartial('_view',[
            'model'=> $this->findModel($id),
        ]);
    }
}
