<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personadireccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personadireccion-form">

<!-- vista del tab datos de contacto del formulario-->
<div class="datosContacto" >
    <div class="row">

        <div id="telefonoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($persona, 'telefonoPersona')->textInput(['maxlength' => true])->label('Telefono') ?>
        </div>

        <div id="mailPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($persona, 'mailPersona')->input('email')->label('E-mail') ?>
        </div>

    </div>
    
    <div class="row">
            
        <div id="nombreProvincia" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($provincia, 'idProvincia')->widget(Select2::classname(), [
                'data' => $provinciaLista,
                'id'=>'idProvincia',
                'options' => [
                    'placeholder' => 'Seleccione una provincia...',
                    'id'=>'idProvincia']
                ])->label('Provincia:'); ?>
        </div>

        <div id="idLocalidad" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($localidad, 'idLocalidad')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'pluginOptions'=>[
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
                <?= $form->field($personaDireccion, 'direccionUsuario')->textInput(['maxlength' => true])->label('Direccion')->label('Calle:') ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                <?= $form->field($personaDireccion, 'direccionUsuario')->textInput(['maxlength' => true])->label('Direccion')->label('N°:') ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                <?= $form->field($personaDireccion, 'direccionUsuario')->textInput(['maxlength' => true])->label('Direccion')->label('Piso:') ?>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2">
                <?= $form->field($personaDireccion, 'direccionUsuario')->textInput(['maxlength' => true])->label('Direccion')->label('Depto:') ?>
            </div>
        </div>
    </div>

</div>

    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>
