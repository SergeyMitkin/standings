<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Games */

$this->title = 'Создать игру';
$this->params['breadcrumbs'][] = ['label' => 'Игра', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'team_list' => $team_list
    ]) ?>

</div>
