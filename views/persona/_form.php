<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form reglamento-container">

    <?php $form = ActiveForm::begin(); ?>

   <!-- <?= $form->field($model, 'idTalleRemera')->textInput() ?>-->
    <?php
         if ($model->isNewRecord){   
            echo $form->field($model, 'idTalleRemera')->dropDownList($model->talle, 
             ['prompt'=>'- Selecciona uno...']);
          }else{
	         echo $form->field($model, 'idTalleRemera')->dropDownList($model->talle,
             ['value' => !empty($model->idTalleRemera) ? $model->idTalleRemera :['prompt'=>'Selecciona uno...']]);
         }
	    ?>

    <?= $form->field($model, 'nombrePersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechaNacPersona')->textInput() ?>

    <?= $form->field($model, 'sexoPersona')->dropdownList(['M'=>'Masculino','F'=>'Femenino','O'=>'Otro']) ?>

    <?= $form->field($model, 'nacionalidadPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefonoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailPersona')->textInput(['maxlength' => true]) ?>

   <!-- <?= $form->field($model, 'idUsuario')->textInput() ?>-->

   <!-- <?= $form->field($model, 'idPersonaDireccion')->textInput() ?>-->

   <!-- <?= $form->field($model, 'idFichaMedica')->textInput() ?>-->

    <?= $form->field($model, 'fechaInscPersona')->textInput() ?>

   <!-- <?= $form->field($model, 'idPersonaEmergencia')->textInput() ?>-->

    <!--<?= $form->field($model, 'idResultado')->textInput() ?>-->

    <?= $form->field($model, 'donador')->dropdownList(['0'=>'no','1'=>'si']) ?>

    <?= $form->field($model, 'deshabilitado')->dropdownList(['0'=>'no','1'=>'si']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
