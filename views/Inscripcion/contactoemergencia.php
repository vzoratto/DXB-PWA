<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personaemergencia-form">

<!-- vista del tab contacto de emergencia del formulario-->
<div class="contactoEmergencia" >
    <div class="row">
        <div id="nombrePersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($datosEmergencia, 'nombrePersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Martin']) ?>
        </div>

        <div id="apellidoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($datosEmergencia, 'apellidoPersonaEmergencia')->textInput(['maxlength' => true,'placeholder'=>'Sambueza']) ?>
        </div>
    </div>
    <div class="row">
        <!-- Ingreso de telefono. Se utiliza el widget phoneinput para ayudar el ingreso del mismo -->
        <div id="telefonoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <label>Telefono:</label><br>
            <?= $form->field($datosEmergencia, 'telefonoPersonaEmergencia')->widget(PhoneInput::className(), [
                'jsOptions' => [
                    'allowExtensions' => true,
                    'preferredCountries' => ['ar', 'br', 'cl', 'uy', 'py', 'bo'],
                    'nationalMode' => false,
                ]
            ])->label('') ?>
        </div>

        <div id="idVinculoPersonaEmergencia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <!-- campo tipo select tambien llamado dropDownList,
        se carga con los datos de la base, especificamente de la tabla VinculoPersona-->
        <?= $form->field($datosEmergencia, 'idVinculoPersonaEmergencia')->dropDownList(
            //se traen los datos de la tabla especificada, el id se lo tomará como valor mientras que el nombre es lo que se mostrará en pantalla para seleccionar 
                \yii\helpers\ArrayHelper::map(\app\models\VinculoPersona::find()->all(),'idVinculo','nombreVinculo'),
                ['prompt'=>'Seleccione un vinculo...']//texto que se mostrará por defecto hasta que se seleccione un vinculo
        )->label('Vinculo'); ?>
        </div>
    </div>
</div>




</div>