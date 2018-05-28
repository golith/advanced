<?php

namespace backend\controllers;

use backend\models\PolicyProc;
use Yii;
use backend\models\Policy;
use backend\models\PolicySearch;
use backend\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PolicyController implements the CRUD actions for Policy model.
 */
class PolicyController extends Controller
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
     * Lists all Policy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PolicySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $policy = new Policy;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'policy' => $policy,
        ]);
    }

    /**
     * Displays a single Policy model.
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
     * Creates a new Policy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Policy();
        $modelsProcItem = [new PolicyProc];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imageName = $model->title;
            $modelsProcItem = Model::createMultiple(PolicyProc::classname());
            Model::loadMultiple($modelsProcItem, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProcItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsProcItem as $modelProcItem) {
                            $modelProcItem->policy_id = $model->policy_id; // check this line it may cause a bug

                            // add rest of function
                            if (UploadedFile::getInstance($model, 'file')) {

                                $model->file = UploadedFile::getInstance($model, 'file');
                                $model->file->saveAs('uploads/policy/' . $imageName . '.' . $model->file->extension);

                                //save path to the db
                                $model->logo = 'uploads/policy/' . $imageName . '.' . $model->file->extension;
                                $model->created = Date('Y-m-d H:i:s');
                            } else {
                                $model->file = 'noimage.jpg';
                                $model->file->saveAs('uploads/policy/' . $imageName . '.jpg');
                                $model->created = Date('Y-m-d H:i:s');
                            }

                            if (!($flag = $modelProcItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->policy_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsProcItem' => (empty($modelsProcItem)) ? [new PolicyProc] : $modelsProcItem
            ]);
        }
    }

    /**
     * Updates an existing Policy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->created = Date('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['view', 'id' => $model->policy_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Policy model.
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
     * Finds the Policy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Policy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Policy::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAjaxView($id)
    {
        return $this->renderPartial('_view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function hasUserSeenPolicy()
    {


    }


}
