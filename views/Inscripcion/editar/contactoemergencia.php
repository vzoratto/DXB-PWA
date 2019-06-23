<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaemergencia-form" id="cuartoStep">

    <!-- vista del tab contacto de emergencia del formulario-->
    <div class="contactoEmergencia" >
        <div class="row no-label">
            <div id="nombrePersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div>Nombre de emergencia</div>
                <?= $form->field($datosEmergencia, 'nombrePersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Nombre de emergencia']) ?>
            </div>

            <div id="apellidoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div>Apellido de emergencia</div>
                <?= $form->field($datosEmergencia, 'apellidoPersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Apellido de emergencia']) ?>
            </div>
        </div>
        <div class="row">
            <!-- Ingreso de telefono. Se utiliza el widget phoneinput para ayudar el ingreso del mismo -->
            <div id="telefonoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div>Teléfono</div>
                <?= $form->field($datosEmergencia, 'telefonoPersonaEmergencia')->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'allowExtensions' => true,
                        'preferredCountries' => ['ar', 'br', 'cl', 'uy', 'py', 'bo'],
                        'nationalMode' => false,
                    ]
                ])->label('') ?>
                <div id="msjTelefonoIgual"></div>
            </div>

            <div id="idVinculoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <div>Vínculo</div>
                <!-- campo tipo select tambien llamado dropDownList,
                se carga con los datos de la base, especificamente de la tabla VinculoPersona-->
                <?= $form->field($datosEmergencia, 'idVinculoPersonaEmergencia')->dropDownList(
                    //se traen los datos de la tabla especificada, el id se lo tomará como valor mientras que el nombre es lo que se mostrará en pantalla para seleccionar
                        \yii\helpers\ArrayHelper::map(\app\models\VinculoPersona::find()->all(),'idVinculo','nombreVinculo'),
                        ['prompt'=>'Vínculo del contacto']//texto que se mostrará por defecto hasta que se seleccione un vinculo
                )->label(''); ?>
            </div>
        </div>
    </div>


</div>
