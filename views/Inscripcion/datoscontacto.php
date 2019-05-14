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

    <div id="telefonoPersona">
        <?= $form->field($persona, 'telefonoPersona')->textInput(['maxlength' => true])->label('Telefono') ?>
    </div>

    <div id="mailPersona">
        <?= $form->field($persona, 'mailPersona')->textInput(['maxlength' => true])->label('E-mail') ?>
    </div>

    <div id="idProvincia">
        <?= $form->field($provincia, 'nombreProvincia')->widget(Select2::classname(), [
            'data' => $provinciaLista,
            'id'=>'idProvincia',
            'options' => [
                'placeholder' => 'Seleccione una provincia...',
                'id'=>'idProvincia']
            ])->label('Provincia'); ?>
    </div>

    <div id="idLocalidad">
        <?= $form->field($localidad, 'nombreLocalidad')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions'=>[
                    'placeholder' => 'Seleccione una localidad...',
                    'depends'=>['idProvincia'],
                    'url'=>Url::to(['localidad/localidades']),
                    'loadingText' => 'Cargando clientes...']
        ])->label('Localidad');
        ?>
    </div>
    
    <div id="direccionUsuario">
        <?= $form->field($personaDireccion, 'direccionUsuario')->textInput(['maxlength' => true])->label('Direccion') ?>
    </div>

</div>

    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>
