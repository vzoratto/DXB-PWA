<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaemergencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($datosEmergencia, 'nombrePersonaEmergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($datosEmergencia, 'apellidoPersonaEmergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($datosEmergencia, 'telefonoPersonaEmergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($datosEmergencia, 'idVinculoPersonaEmergencia')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>