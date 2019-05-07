<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonaemergenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaemergencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPersonaEmergencia') ?>

    <?= $form->field($model, 'nombrePersonaEmergencia') ?>

    <?= $form->field($model, 'apellidoPersonaEmergencia') ?>

    <?= $form->field($model, 'telefonoPersonaEmergencia') ?>

    <?= $form->field($model, 'idVinculoPersonaEmergencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
