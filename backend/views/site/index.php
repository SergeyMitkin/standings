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

        <?// $dataProvider->setModels($dataProvider->getModels()); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'label' => 'Положение команд',
                    'content' => function($model, $key, $index, $column){

                        $place = $index+1; // Турнирное положение

                        if(\Yii::$app->request->get()['sort'] !== null && \Yii::$app->request->get()['sort'] == 'points'){
                            $place = $column->grid->dataProvider->totalCount - $index;
                        }

                        return
                            '<span class="team-name-span"><b>' . $place . '</b></span>' .

                            Html::img($model->logo_source,[
                            'alt'=>'Эмблема команды',
                            'style' => 'width:50px'
                            ]) .

                            '<span class="team-name-span"><b>' . $model->name . '</b></span>'
                            ;

                    }
                ],
                'games',
                'gf',
                'ga',
                'points',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);

        ?>

    </div>
</div>
