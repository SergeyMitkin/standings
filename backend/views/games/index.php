<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\tables\Teams;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\GamesFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Игры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить игру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'home_id',
                'label' => 'Хозяева',
                'format' => 'html',
                'filter' => ArrayHelper::map(Teams::find()->all(), 'id', 'name'),
                'value' => function($model){
                    return Html::tag('span', $model->home->name);
                }
            ],
            'home_goals',
            'visitor_goals',
            [
                'attribute' => 'visitor_id',
                'label' => 'Гости',
                'format' => 'html',
                'filter' => ArrayHelper::map(Teams::find()->all(), 'id', 'name'),
                'value' => function($model){
                    return Html::tag('span', $model->visitor->name);
                }
            ],
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
