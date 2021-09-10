<?php

namespace backend\controllers;

use app\models\tables\Teams;
use app\models\filters\TeamsFilter;
use backend\models\Upload;
use phpDocumentor\Reflection\Types\Null_;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TeamsController implements the CRUD actions for Teams model.
 */
class TeamsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Teams models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeamsFilter();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teams model.
     * @param int $id ID
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
     * Creates a new Teams model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teams();
        $model_upload = new Upload(); // Модель загрузки файлов

        if ($this->request->isPost) {

            if (UploadedFile::getInstance($model_upload, 'team_logo') !== Null){
                // Загружаем эмблему команды
                $model_upload->team_logo = UploadedFile::getInstance($model_upload, 'team_logo');

                // Сохраняем адрес изображения эмблемы
                $logo_array = ['logo_source' => $model_upload->uploadCommonImage()];
                $model->attributes = array_merge($this->request->post()['Teams'], $logo_array);

                if ($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'model_upload' => $model_upload
        ]);
    }

    /**
     * Updates an existing Teams model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_upload = new Upload();

        if ($this->request->isPost){

            // Загружаем эмблему команды
            if (UploadedFile::getInstance($model_upload, 'team_logo') !== Null){
                $model_upload->team_logo = UploadedFile::getInstance($model_upload, 'team_logo');

                // Сохраняем адрес изображения эмблемы
                $logo_array = ['logo_source' => $model_upload->uploadCommonImage()];
                $model->attributes = array_merge($this->request->post()['Teams'], $logo_array);

                if ($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_upload' => $model_upload
        ]);
    }

    /**
     * Deletes an existing Teams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Teams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Teams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teams::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
