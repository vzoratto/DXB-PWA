<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPersona') ?>

    <?= $form->field($model, 'nombrePersona') ?>

    <?= $form->field($model, 'apellidoPersona') ?>

    <?= $form->field($model, 'fechaNacPersona') ?>

    <?= $form->field($model, 'idSexoPersona') ?>

    <?php // echo $form->field($model, 'nacionalidadPersona') ?>

    <?php // echo $form->field($model, 'telefonoPersona') ?>

    <?php // echo $form->field($model, 'mailPersona') ?>

    <?php // echo $form->field($model, 'idUsuario') ?>

    <?php // echo $form->field($model, 'mailPersonaValidado') ?>

    <?php // echo $form->field($model, 'codigoValidacionMail') ?>

    <?php // echo $form->field($model, 'codigoRecuperarCuenta') ?>

    <?php // echo $form->field($model, 'idPersonaDireccion') ?>

    <?php // echo $form->field($model, 'idFichaMedica') ?>

    <?php // echo $form->field($model, 'fechaInscPersona') ?>

    <?php // echo $form->field($model, 'idPersonaEmergencia') ?>

    <?php // echo $form->field($model, 'idResultado') ?>

    <?php // echo $form->field($model, 'idEncuesta') ?>

    <?php // echo $form->field($model, 'deshabilitado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
