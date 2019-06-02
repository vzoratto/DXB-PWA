<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

<!-- vista del tab datos personales del formulario-->
<div class="datosPersonales" >

    <div class="row">

        <label>Soy capitan?</label>
        <!-- Rounded switch -->
        <div class="onoffswitch col-1">
            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="myFunction()" >
            <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner"></span>
                <span class="onoffswitch-switch"></span>
            </label>
        </div>
        
    </div>

    <div class="row">
        <div id="opcionesCapitan" style="display:none" aria-label="..." class="col-1">

            <div id="tipoCarrera" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(Select2::classname(), [
                    'data' => $tipocarreraLista,
                    'id'=>'idTipoCarrera',
                    'options' => [
                        'placeholder' => 'Seleccione una carrera...', 'id'=>'idTipocarrera'
                    ],
                    ])->label('Carreras'); ?>
            </div>

            <div id="cantidadPeronas" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                <?= $form->field($equipo, 'cantidadPersonas')->widget(Select2::classname(), [
                'data' => $cantCorredores,
                'id'=>'idParametros',

                'options' => [
                    'placeholder' => 'Seleccione una opcion...', 'id'=>'idParametros',
                ],
                ])->label('Cantidad de corredores'); ?>
            </div>
            

        </div>
    </div>

    <div class="row">
    <div id="opcionesNoSoyCapitan" style="display:block" aria-label="..." class="col-1">

        <div id="dniCapitan" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
        <?= $form->field($equipo, 'dniCapitan')->widget(Select2::classname(), [
            'data' => $equipoLista,
            'id'=>'idEquipo',
            'options' => [
                'placeholder' => 'Ingrese el D.N.I. de su capitan...', 'id'=>'idEquipo'
            ],
            ])->label('D.N.I. Capitan'); ?>
        </div>
        
        <div id="tipoDeCarrera" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
            <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Carrera...',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/tipocarrera']),
                        'loadingText' => 'Cargando datos...']
            ])->label('Carrera');
            ?>
        </div>

        <div id="cantidadPersonas" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
            <?= $form->field($equipo, 'cantidadPersonas')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Equipo de ...',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/cantpersonas']),
                        'loadingText' => 'Cargando datos...']
            ])->label('Cantidad de corredores');
            ?>
        </div>

        <div id="nombreEquipo" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
            <?= $form->field($equipo, 'nombreEquipo')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Nombre capitan...',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/datos']),
                        'loadingText' => 'Cargando datos...']
            ])->label('Nombre equipo');
            ?>
        </div>





    </div>

    </div>
    <div class="row">

        <div id="dniUsuario" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <?= $form->field($usuario, 'dniUsuario')->textInput()->label('D.N.I.') ?>
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
            <label>Fecha de Nacimiento <small style="color:red">(Podés correr a partir de los 12 años)</small></label>
            <?=  $form->field($persona, 'fechaNacPersona')->textInput(['class'=>'datepicker form-control','id'=>'datepicker'])->label('') ?>

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


