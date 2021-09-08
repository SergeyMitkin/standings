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
            'filterModel' => $searchModel,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //  'id',
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
                            Html::img($data->logo_source,[
                                'alt'=>'Эмблема команды',
                                'style' => 'width:50px;'

                            ]);
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);

        ?>

    </div>
</div>
