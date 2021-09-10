<?php

namespace backend\controllers;

use backend\models\tables\Games;
use backend\models\filters\GamesFilter;
use backend\models\tables\Teams;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GamesController implements the CRUD actions for Games model.
 */
class GamesController extends Controller
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
     * Lists all Games models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GamesFilter();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Games model.
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
     * Creates a new Games model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Games();

        // При добавлении игры, изменяем записи команд в таблице teams
        Event::on(Games::class, Games::EVENT_AFTER_INSERT, function ($event){

            $game_id = $event->sender['id']; // Id дабавленной игры

            // Данные из $_POST
            $post = $this->request->post()['Games'];
            $home_id = $post['home_id'];
            $visitor_id = $post['visitor_id'];
            $home_goals = $post['home_goals'];
            $visitor_goals = $post['visitor_goals'];
            $date = $post['date'];

            $model_teams = new Teams();
            $model_teams->gamePlayed($game_id, $home_id, $visitor_id, $home_goals, $visitor_goals, $date);

        });

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

               return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        // Список команд
        $team_list = ArrayHelper::map(Teams::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'team_list' => $team_list
        ]);
    }

    /**
     * Updates an existing Games model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Перед редактированием игры, вычитаем у команд голы и очки за эту игру
        Event::on(Games::class, Games::EVENT_BEFORE_UPDATE, function ($event){

            $game_id = $event->sender['id'];

            $model_teams = new Teams();
            $model_teams->gameDeleted($game_id);

        });

        // После редактирования, добавляем командам голы и очки за эту игру
        Event::on(Games::class, Games::EVENT_AFTER_UPDATE, function ($event){

            $game_id = $event->sender['id'];

            $post = $this->request->post()['Games'];
            $home_id = $post['home_id'];
            $visitor_id = $post['visitor_id'];
            $home_goals = $post['home_goals'];
            $visitor_goals = $post['visitor_goals'];
            $date = $post['date'];

            $model_teams = new Teams();
            $model_teams->gameUpdated($game_id, $home_id, $visitor_id, $home_goals, $visitor_goals, $date);

        });

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
           // return $this->redirect(['view', 'id' => $model->id]);
        }

        // Список команд
        $team_list = ArrayHelper::map(Teams::find()->all(), 'id', 'name');

        return $this->render('update', [
            'model' => $model,
            'team_list' => $team_list
        ]);
    }

    /**
     * Deletes an existing Games model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // Перед удалением игры, обновляем записи игравших команд (голы, очки)
        Event::on(Games::class, Games::EVENT_BEFORE_DELETE, function ($event){

            $game_id = $event->sender['id'];

            $model_teams = new Teams();
            $model_teams->gameDeleted($game_id);

        });

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Games model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Games the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Games::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
