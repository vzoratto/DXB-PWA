<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($usuario, 'cuilUsuario')->textInput() ?>

    <?= $form->field($persona, 'nombrePersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($persona, 'apellidoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($persona, 'fechaNacPersona')->textInput() ?>

    <?= $form->field($persona, 'idSexoPersona')->textInput() ?>

    <?= $form->field($persona, 'nacionalidadPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($persona, 'telefonoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($persona, 'mailPersona')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>