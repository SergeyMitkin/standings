<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Games */

$this->title = 'Редактировать игру: ';
$this->params['game_name'];
$this->params['breadcrumbs'][] = ['label' => 'Игры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $game_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="games-update">

    <div class="page-title-div">
        <h1 class="page-title-h"><?= Html::encode($this->title) ?></h1>
        <span class="page-title-span">«<?=$game_name?>»</span>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'team_list' => $team_list
    ]) ?>

</div>
