<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombrePersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaNacPersona')->textInput() ?>

    <?= $form->field($model, 'idSexoPersona')->textInput() ?>

    <?= $form->field($model, 'nacionalidadPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefonoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'mailPersonaValidado')->textInput() ?>

    <?= $form->field($model, 'codigoValidacionMail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigoRecuperarCuenta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPersonaDireccion')->textInput() ?>

    <?= $form->field($model, 'idFichaMedica')->textInput() ?>

    <?= $form->field($model, 'fechaInscPersona')->textInput() ?>

    <?= $form->field($model, 'idPersonaEmergencia')->textInput() ?>

    <?= $form->field($model, 'idResultado')->textInput() ?>

    <?= $form->field($model, 'idEncuesta')->textInput() ?>

    <?= $form->field($model, 'deshabilitado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
