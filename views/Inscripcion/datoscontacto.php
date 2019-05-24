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

<div class="personadireccion-form">

<!-- vista del tab datos de contacto del formulario-->
<div class="datosContacto" >
    <div class="row">

        <div id="telefonoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <label>Telefono:</label><br>
            <?= $form->field($persona, 'telefonoPersona')->widget(PhoneInput::className(), [
                'jsOptions' => [
                'allowExtensions' => true,
                'preferredCountries' => ['ar', 'br', 'cl', 'uy', 'py', 'bo'],
                'nationalMode' => false,
                ]
            ])->label('') ?> 
        </div>

        <div id="mailPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($persona, 'mailPersona')->textInput(['maxlength' => true])->label('E-Mail') ?>
        </div>

    </div>
    
    <div class="row">
            
        <div id="nombreProvincia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($provincia, 'idProvincia')->widget(Select2::classname(), [
                'data' => $provinciaLista,
                'id'=>'idProvincia',
                'options' => [
                    'value' => '20',
                    'placeholder' => 'Seleccione una provincia...',
                    'id'=>'idProvincia']
                ])->label('Provincia:'); ?>
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
            ])->label('Localidad:');
            ?>
        </div>
    </div>
    
    <div id="direccionUsuario"> 
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
            <label>Calle: </label>
                <?= Html::input('text','calle',$datos['calle'], $option=['class'=>'form-control']) ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                <label>N°: </label>
                <?=  Html::input('text','numero', $datos['numero'], $option=['class'=>'form-control']) ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                <label>Piso: </label>
                <?= Html::input('text','piso', $datos['piso'], $option=['class'=>'form-control']) ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
            <label>Departamento: </label>
                <?= Html::input('text','departamento', $datos['departamento'], $option=['class'=>'form-control']) ?>
            </div>
           
            <?=  
                $value = $datos['calle'].' '.$datos['numero'].' '.$datos['departamento'].' '.$datos['piso'];
                $form->field($personaDireccion, 'direccionUsuario')->hiddenInput(['value' => $value])->label(false) ?>
        </div>
    </div>
    
</div>

    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>
