<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Teams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'games')->textInput() ?>

    <?= $form->field($model, 'gf')->textInput() ?>

    <?= $form->field($model, 'ga')->textInput() ?>

    <?= $form->field($model, 'points')->textInput() ?>

    <?= $form->field($model_upload, 'team_logo')->fileInput()?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
