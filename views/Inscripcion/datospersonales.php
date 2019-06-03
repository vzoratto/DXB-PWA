<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;


/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

<!-- vista del tab datos personales del formulario-->
<div class="datosPersonales" >

    <div class="row">
        <div class="left" >
            <label>¿Soy Capitan?</label>
        </div>
        <div class="switch pull-left" >
            <input type="radio" class="switch-input" name="swichtCapitan" value="1" id="week" onClick=myFunction() >
            <label for="week" class="switch-label switch-label-off">SI</label>
            <input type="radio" class="switch-input" name="swichtCapitan" value="0" id="month" checked onClick=myFunction()>
            <label for="month" class="switch-label switch-label-on">NO</label>
            <span class="switch-selection"></span>
        </div>
    </div>

        
    <div class="row">
        <div id="opcionesCapitan" style="display:none" aria-label="..." class="col-1">

            <div id="tipoCarrera" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
                <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(Select2::classname(), [
                    'data' => $tipocarreraLista,
                    'id'=>'idTipoCarrera',
                    'options' => [
                        'placeholder' => 'Seleccione una carrera...', 'id'=>'idTipocarrera'
                    ],
                    ])->label('Carreras'); ?>
            </div>

            <div id="cantidadPeronas" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
                <?= $form->field($equipo, 'cantidadPersonas')->widget(Select2::classname(), [
                'data' => $cantCorredores,
                'id'=>'idParametros',
                'options' => [
                    'placeholder' => 'Seleccione una opcion...', 'id'=>'idParametrosCantPersonas',
                ],
                ])->label('Cantidad de corredores'); ?>
            </div>
            

        </div>
    </div>

    <div class="row">
    <div id="opcionesNoSoyCapitan" style="display:block" aria-label="..." class="col-1">

        <div id="dniCapitan" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
        <?= $form->field($equipo, 'idEquipo')->widget(Select2::classname(), [
            'data' => $equipoLista,
            'id'=>'idEquipo',
            'options' => [
                'placeholder' => 'Ingrese el D.N.I. de su capitan...', 'id'=>'idEquipo'
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 5,
            ]
            ])->label('D.N.I. Capitan'); ?>
        </div>
        
        <div id="nombreCapitan" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <?= $form->field($persona, 'nombrePersona')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idNombreCapitan',
                    ],
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Esperando D.N.I. capitan...',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/nombrecapitan']),
                        'loadingText' => 'Esperando D.N.I. capitan...']
            ])->label('Nombre capitan');
            ?>
        </div>
        

        <div id="tipoDeCarrera" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idTipoDeCarrera',
                    ],
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Carrera...',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/tipocarrera']),
                        'loadingText' => 'Esperando D.N.I. capitan...']
            ])->label('Carrera');
            ?>
        </div>

        <div id="cantidadPersonas" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <?= $form->field($equipo, 'cantidadPersonas')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idCantidadPersonas',
                    ],
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Equipo de ...',
                        'depends'=>['idEquipo'],
                        'id'=>'cantPersonas',
                        'url'=>Url::to(['inscripcion/cantpersonas']),
                        'loadingText' => 'Esperando D.N.I. capitan...']
            ])->label('Cantidad de corredores');
            ?>
        </div>
        
        <?php /*
        <div id="nombreEquipo" class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
            <?= $form->field($equipo, 'nombreEquipo')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idNombreEquipo',
                    ],
                    'pluginOptions'=>[
                        'initialize' => true,
                        'placeholder' => 'Nombre capitan...',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/datos']),
                        'loadingText' => 'Esperando D.N.I. capitan...']
            ])->label('Nombre equipo');
            ?>
        </div>
        */?>

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
            <?=  $form->field($persona, 'fechaNacPersona')->textInput(['class'=>'datepicker form-control','id'=>'datepicker'])->label('Fecha de Nacimiento') ?>
            <small style="color:red">(Podés correr a partir de los 12 años)</small>

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

<?php
$script = <<<JS

JS;

$this->registerJs($script);
?>
