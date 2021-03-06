<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EquipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipo-search reglamento-container">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idEquipo') ?>

    <?= $form->field($model, 'nombreEquipo') ?>

    <?= $form->field($model, 'cantidadPersonas') ?>

    <?= $form->field($model, 'idTipoCarrera') ?>

    <?= $form->field($model, 'dniCapitan') ?>

    <?php // echo $form->field($model, 'deshabilitado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
