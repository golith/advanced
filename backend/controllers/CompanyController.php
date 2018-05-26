<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $company = new Company;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'company' => $company,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imageName = $model->company_name;

            if (UploadedFile::getInstance($model, 'file')) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('uploads/logos/' . $imageName . '.' . $model->file->extension);

                //save path to the db
                $model->logo = 'uploads/logos/' . $imageName . '.' . $model->file->extension;
            } else {
                $model->file = 'noimage.jpg';
                $model->file->saveAs('uploads/logos/' . $imageName . '.jpg');
            }
            $model->created = Date('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['view', 'id' => $model->company_id]);

        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//
//            $imageCheck = UploadedFile::getInstance($model, 'file');
//
//            if ($imageCheck) {
//                $imageName = $model->company_name;
//                $model->file = UploadedFile::getInstance($model, 'file');
//                $model->file->saveAs('uploads/logos/' . $imageName . '.' . $model->file->extension);
//
//                //save path to the db
//                $model->logo = 'uploads/logos/' . $imageName . '.' . $model->file->extension;
//                $model->updated = Date('Y-m-d H:i:s');
//                $model->save();
//
//            } else {
//                $model->updated = Date('Y-m-d H:i:s');
//                $model->save();
//            }

            return $this->redirect(['view', 'id' => $model->company_id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
//        if (Yii::$app->user->can('see-company') && !Yii::$app->user->getIsGuest()) {
//
//            if (Yii::$app->user->can('delete-company')) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
//            } else {
//                return $this->render('view', [
//                    'model' => $this->findModel($id),
//                ]);
//                throw new ForbiddenHttpException;
//            }
//        } else {
//            throw new ForbiddenHttpException;
//        }
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /** **********************************************************************
     *  Custom actions for the CompanyController
     ********************************************************************** **/

    public function actionLists()
    {
        if ($id = Yii::$app->request->post('company_id')) {
            $countA = Company::find()
                ->where(['company_id' => $id])
                ->count();

            if ($countA > 0) {
                $companies = Company::find()
                    ->where(['company_id' => $id])
                    ->all();
                foreach ($companies as $company)
                    echo "<option value='" . $company->company_id . "'>" . $company->company_name . "</option>";
            } else {
                echo "<option></option>";
            }
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

//            $this->renderPartial('_viewBranch', [
//                'model' => $this->findModel($id),
        ]);
    }
}
