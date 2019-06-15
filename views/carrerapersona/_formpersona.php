<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model->persona, 'nombrePersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->persona, 'apellidoPersona')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model->persona, 'telefonoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->persona, 'fechaNacPersona')->textInput(['disabled' => true]) ?>

    <?= $form->field($model->persona, 'sexoPersona')->textInput(['disabled' => true,'maxlength' => true]) ?>

    <?= $form->field($model->persona, 'nacionalidadPersona')->textInput(['disabled' => true,'maxlength' => true]) ?>

    

    <?= $form->field($model->persona, 'mailPersona')->textInput(['disabled' => true,'maxlength' => true]) ?>

    <?= $form->field($model->persona, 'idUsuario')->textInput(['disabled' => true]) ?>

    <?= $form->field($model->persona, 'idPersonaDireccion')->textInput(['disabled' => true,]) ?>

    <?= $form->field($model->persona, 'idFichaMedica')->textInput(['disabled' => true]) ?>

    <?= $form->field($model->persona, 'fechaInscPersona')->textInput() ?>

    <?= $form->field($model->persona, 'idPersonaEmergencia')->textInput(['disabled' => true]) ?>

    <?= $form->field($model->persona, 'idResultado')->textInput(['disabled' => true]) ?>

    <?= $form->field($model->persona, 'donador')->textInput(['disabled' => true]) ?>

    <?= $form->field($model->persona, 'deshabilitado')->textInput(['type'=>"hidden"]) ?>
	
     <?= $form->field($model->persona, 'idTalleRemera')->textInput(['disabled' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton('Guardar Datos', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
