<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TeamsFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Команды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать команду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute' => 'id',
                'headerOptions' => [
                        'class' => 'col-md-1'
                ]
            ],
            'name',
            'games',
            'gf',
            'ga',
            'points',
            [
                'label' => 'Эмблема',
                'format' => 'raw',
                'value' => function($data){
                    return
                        Html::img($data->logo_source_small,[
                        'alt'=>'Эмблема команды',
                        'style' => 'width:50px;'
                    ]);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
