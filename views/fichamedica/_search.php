<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FichamedicaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichamedica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idFichaMedica') ?>

    <?= $form->field($model, 'obraSocial') ?>

    <?= $form->field($model, 'peso') ?>

    <?= $form->field($model, 'altura') ?>

    <?= $form->field($model, 'frecuenciaCardiaca') ?>

    <?php // echo $form->field($model, 'idGrupoSanguineo') ?>

    <?php // echo $form->field($model, 'evaluacionMedica') ?>

    <?php // echo $form->field($model, 'intervencionQuirurgica') ?>

    <?php // echo $form->field($model, 'tomaMedicamentos') ?>

    <?php // echo $form->field($model, 'suplementos') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
