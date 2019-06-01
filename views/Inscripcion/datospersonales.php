<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="persona-form">

<!-- vista del tab datos personales del formulario-->
<div class="datosPersonales" id="datosPersonalesForm" >
<div class="row">
        <label>Soy capitan?</label>
        <!-- Rounded switch -->
        <div class="onoffswitch">
            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="myFunction()" >
            <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        <div id="opcionesCapitan" style="display:none" aria-label="...">
            <h3> cosas de capitan </h3>
        </div>
    </div>
    <div class="row">

        <div id="dniUsuario" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <?= $form->field($usuario, 'dniUsuario')->textInput()->label('D.N.I') ?>
        </div>
        
        <div id="nacionalidadPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <?= $form->field($persona, 'nacionalidadPersona')->textInput(['maxlength' => true])->label('Nacionalidad') ?>
        </div>
    </div>
    <div class="row">
        <div id="nombrePersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($persona, 'nombrePersona')->textInput(['maxlength' => true])->label('Nombre') ?>
        </div>

        <div id="apellidoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($persona, 'apellidoPersona')->textInput(['maxlength' => true])->label('Apellido') ?>
        </div>
    </div>
    <div class="row">
        <div id="fechaNacPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <!-- utilizacion de un widget de kartik llamado DatePicker, permite escoger 
        una fecha desde un calendario permitiendo tambien seleccionar años o meses 
        con una mayor facilidad --> 
            <label>Fecha de Nacimiento</label>
            <?= DatePicker::widget([
                'name' => 'fechaNacPersona',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'options' => ['placeholder' => 'Seleccione su fecha de nacimiento'],//Contenido que se mostrará dentro del input
                'language' => 'es',//definicion del lenguaje del widget
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',//definicion del formato de fecha 
                ]
            ])?>
        </div>

        <div id="sexoPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
            <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
            <?= $form->field($persona, 'sexoPersona')->radioList(array('F'=>'Femenino','M'=>'Masculino'))
                                                            ->label('Sexo'); ?>
        </div>

        <div id="talleRemera" class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <?=$form->field($talleRemera, 'idTalleRemera')->dropDownList($listadoTalles, ['prompt' => 'Seleccione su talle' ])->label('Talle Remera'); ?>
        </div>
    </div>
    
</div>
                
</div>
