<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaemergencia-form">

<!-- vista del tab contacto de emergencia del formulario-->
<div class="contactoEmergencia" >
    <div class="row no-label">
        <div id="nombrePersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($datosEmergencia, 'nombrePersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Nombre de emergencia']) ?>
        </div>

        <div id="apellidoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($datosEmergencia, 'apellidoPersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Apellido de emergencia']) ?>
        </div>
    </div>
    <div class="row">
        <div id="telefonoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($datosEmergencia, 'telefonoPersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Teléfono de emergencia']) ?>
        </div>

        <div id="idVinculoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <!-- campo tipo select tambien llamado dropDownList,
        se carga con los datos de la base, especificamente de la tabla VinculoPersona-->
        <?= $form->field($datosEmergencia, 'idVinculoPersonaEmergencia')->dropDownList(
            //se traen los datos de la tabla especificada, el id se lo tomará como valor mientras que el nombre es lo que se mostrará en pantalla para seleccionar
                \yii\helpers\ArrayHelper::map(\app\models\VinculoPersona::find()->all(),'idVinculo','nombreVinculo'),
                ['prompt'=>'Vínculo del contacto']//texto que se mostrará por defecto hasta que se seleccione un vinculo
        )->label('Vinculo'); ?>
        </div>
    </div>
</div>




</div>
