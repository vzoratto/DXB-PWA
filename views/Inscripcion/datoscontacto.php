<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personadireccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personadireccion-form">


    <?= $form->field($persona, 'telefonoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($persona, 'mailPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($personaDireccion, 'idLocalidad')->textInput() ?>

    <?= $form->field($personaDireccion, 'direccionUsuario')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>
