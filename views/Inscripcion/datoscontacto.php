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

<div class="personadireccion-form" id="segundoStep">

<!-- vista del tab datos de contacto del formulario-->
<div class="datosContacto" >
    <div class="row">
    
        <!-- Ingreso de telefono. Se utiliza el widget phoneinput para ayudar el ingreso del mismo -->
        <div id="telefonoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>Teléfono</div>
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
        <div>E-mail</div>
        <?= $form->field($persona, 'mailPersona')->textInput(['maxlength' => true,'value'=>$user->identity->mailUsuario,'readonly'=> true])->label('') ?>
        </div>

    </div>

    <div class="row">
    
        <div id="nombreProvincia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>Provincia</div>
            <?= $form->field($provincia, 'idProvincia')->widget(Select2::classname(), [
                'data' => $provinciaLista,
                'id'=>'idProvincia',
                'options' => [
                    'value' => '20',
                    'placeholder' => 'Seleccione una provincia...',
                    'id'=>'idProvincia']
                ])->label(''); ?>
        </div>
        
        <div id="idLocalidad" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>Localidad</div>
            <?= $form->field($localidad, 'idLocalidad')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'value' => '4634',
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Seleccione una localidad...',
                        'depends'=>['idProvincia'],
                        'url'=>Url::to(['localidad/localidades']),
                        'loadingText' => 'Cargando localidades...']
            ])->label('');
            ?>
        </div>
    </div>

    <!-- Ingreso de la direccion de la persona -->
    <div id="direccionUsuario"> 
        <div class="row no-label">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" id="calleDireccion">
            <div>Calle</div>
                <?= Html::input('text','calle',$datos['calle'], $option=['class'=>'form-control','id'=>'calle','placeholder' => 'Calle']) ?>
                <div id="msjErrorCalle"></div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2" id="numeroDireccion">
            <div>Número</div>
                <?=  Html::input('text','numero', $datos['numero'], $option=['class'=>'form-control', 'id'=> 'numero','placeholder' => 'Numero']) ?>
                <div id="msjErrorNumero"></div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
            <div>Piso</div>
                <?= Html::input('text','piso', $datos['piso'], $option=['class'=>'form-control', 'placeholder' => 'Piso']) ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
            <div>Departamento</div>
                <?= Html::input('text','departamento', $datos['departamento'], $option=['class'=>'form-control', 'placeholder' => 'Departamento']) ?>
            </div>

        </div>
    </div>

</div>
<br>


</div>
