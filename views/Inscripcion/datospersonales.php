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




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>