<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use borales\extensions\phoneInput\PhoneInput;
use yii\widgets\MaskedInput;




/* @var $this yii\web\View */
/* @var $model app\models\Personadireccion */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $idRol = $user->identity->idRol;
    if ($idRol == 3 || $idRol == 2){ // Si es gestora o administradora
        $soloLectura = false; //Significa que va a poder cambiar los valores del DNI del usuario y su Mail
        $mailUsuario = '';
    } else {
        $soloLectura = true;
        $mailUsuario = $user->identity->mailUsuario;
    }
?>

<div class="personadireccion-form" id="segundoStep">

<!-- vista del tab datos de contacto del formulario-->
<div class="datosContacto" >
    <div class="row db-label">

        <!-- Ingreso de telefono. Se utiliza el widget phoneinput para ayudar el ingreso del mismo -->
        <div id="telefonoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <label id="telefonoPersonaContacto">Teléfono *</label>
            <?= $form->field($persona, 'telefonoPersona')->widget(PhoneInput::className(), [
                'jsOptions' => [
                'allowExtensions' => true,
                'preferredCountries' => ['ar', 'br', 'cl', 'uy', 'py', 'bo'],
                'nationalMode' => false,
                ]
            ])->label('') ?>
        </div>

        <!-- Ingreso del e-mail -->
        <div id="mailPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($persona, 'mailPersona')->textInput(['maxlength' => true,'value'=>$mailUsuario,'readonly'=> $soloLectura,'placeholder'=>'ejemplo@email.com'])->label('E-mail *') ?>
        </div>

    </div>

    <div class="row db-label">

        <div id="nombreProvincia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($provincia, 'idProvincia')->widget(Select2::classname(), [
                'data' => $provinciaLista,
                'id'=>'idProvincia',
                'options' => [
                    'value' => '20',
                    'placeholder' => 'Seleccione una provincia...',
                    'id'=>'idProvincia']
                ])->label('Provincia *'); ?>
        </div>

        <div id="idLocalidad" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($localidad, 'idLocalidad')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'value' => '4634',
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Seleccione una localidad...',
                        'depends'=>['idProvincia'],
                        'url'=>Url::to(['localidad/localidades']),
                        'loadingText' => 'Cargando localidades...']
            ])->label('Localidad *');
            ?>
        </div>
    </div>

    <!-- Ingreso de la direccion de la persona -->
    <div id="direccionUsuario">
        <div class="row db-label">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" id="calleDireccion">
              <label id="calleContacto">Calle *</label>
                <?= Html::input('text','calle',$datos['calle'], $option=['class'=>'form-control','id'=>'calle','placeholder' => 'Calle']) ?>
                <div id="msjErrorCalle"></div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2" id="numeroDireccion">
              <label id="numeroContacto">Número *</label>
                <?=  Html::input('text','numero', $datos['numero'], $option=['class'=>'form-control', 'id'=> 'numero','placeholder' => 'Numero']) ?>
                <div id="msjErrorNumero"></div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
              <label>Piso </label>
                <?= Html::input('text','piso', $datos['piso'], $option=['class'=>'form-control', 'placeholder' => 'Piso']) ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
              <label>Departamento </label>
                <?= Html::input('text','departamento', $datos['departamento'], $option=['class'=>'form-control', 'placeholder' => 'Departamento']) ?>
            </div>

        </div>
    </div>

</div>
<br>


</div>
