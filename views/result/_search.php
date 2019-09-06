<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResultSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="result-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idResultado') ?>

    <?= $form->field($model, 'numEquipo') ?>

    <?= $form->field($model, 'tiempoLlegada') ?>

    <?= $form->field($model, 'respuestasCorrectas') ?>

    <?= $form->field($model, 'bolsasCompletas') ?>

    <?php // echo $form->field($model, 'penalizacionBolsa') ?>

    <?php // echo $form->field($model, 'trivia') ?>

    <?php // echo $form->field($model, 'total') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
