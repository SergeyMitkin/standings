<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Teams */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teams-view">

    <h1 class="view-title col-md-4"><?= Html::encode($this->title) ?></h1>

    <div class="team-logo-div col-md-8">
        <?php
         echo Html::img($model->logo_source,[
                'class' => 'team-logo-img',
                'alt'=>'Эмблема команды',
         ]);
        ?>
    </div>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'games',
            'gf',
            'ga',
            'points',
        ],
    ]) ?>

</div>
