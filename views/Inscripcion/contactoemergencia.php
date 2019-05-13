<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaemergencia-form">



    <?= $form->field($datosEmergencia, 'nombrePersonaEmergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($datosEmergencia, 'apellidoPersonaEmergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($datosEmergencia, 'telefonoPersonaEmergencia')->textInput(['maxlength' => true]) ?>

    <!-- campo tipo select tambien llamado dropDownList, se carga con los datos de la base especificamente de la tabla Busquedas-->
    <?= $form->field($datosEmergencia, 'idVinculoPersonaEmergencia')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\VinculoPersona::find()->all(),'idVinculo','nombreVinculo'),
            ['prompt'=>'Seleccione un vinculo...']
    )->label('Vinculo'); ?>

    <div class="form-group">
        <?= Html::submitButton('Terminar inscripción', ['class' => 'btn btn-success']) ?>
    </div>



</div>