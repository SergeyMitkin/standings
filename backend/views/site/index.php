<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Турнирная таблица';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations, <?=Yii::$app->user->identity->username?>!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => false,
            'columns' => [
                [
                    'attribute' => 'points',
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
                            '<span class="team-place-span"><b>' . $place . '</b></span>' .

                            Html::img($model->logo_source,[
                                'class' => 'team_logo_img',
                                'alt'=>'Эмблема команды',
                                'style' => 'width:50px'
                            ]) .

                            '<span class="team-name-span"><b>' . $model->name . '</b></span>'
                            ;

                    }
                ],
                'games',
                //'gf',
                //'ga',
                [
                    'attribute' => 'goalsAmount',
                    //'label' => 'Мячи',
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
