<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Games */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="games-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'home_id')->dropDownList($team_list) ?>

    <?= $form->field($model, 'visitor_id')->dropDownList($team_list) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'home_goals')->textInput() ?>

    <?= $form->field($model, 'visitor_goals')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
