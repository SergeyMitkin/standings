<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Турнирная таблица';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Турнирная таблица</h1>
    </div>

    <div class="body-content">

        <div class="site-index">

            <div class="body-content">

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'summary' => false,
                    'columns' => [
                        [
                            'attribute' => 'points',
                            'headerOptions' => [
                                'class' => $sorting_order
                            ],
                            'label' => 'Положение команд',
                            'contentOptions' => [
                                'class' => 'col-md-8'
                            ],
                            'content' => function($model, $key, $index, $column){

                                // Турнирное положение
                                $place = $index+1;
                                if(\Yii::$app->request->get()['sort'] !== null && \Yii::$app->request->get()['sort'] == 'points'){
                                    $place = $column->grid->dataProvider->totalCount - $index;
                                }

                                return
                                    '<span class="team-place-span">' . $place . '</span>' .
                                    '<div class="team-logo-div">' .
                                    Html::img($model->logo_source_small,[
                                        'class' => 'team-logo-img',
                                        'alt'=>'Эмблема команды',
                                    ]) .
                                    '</div>' .
                                    '<span class="team-name-span">' . $model->name . '</span>'
                                    ;
                            }
                        ],
                        'games',
                        [
                            'attribute' => 'goalsAmount',
                            'content' => function($model, $key, $index, $column){
                                return
                                    '<span class="team-place-span">' . $model->gf . '</span>' .
                                    ' - ' .
                                    '<span class="team-name-span">' . $model->ga . '</span>'
                                    ;
                            }
                        ],
                        [
                            'attribute' => 'points',
                            'enableSorting' => false
                        ]
                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);

                ?>

            </div>
        </div>


    </div>
</div>
