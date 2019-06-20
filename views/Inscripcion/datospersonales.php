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

<div class="persona-form" id="primerStep">

<!-- vista del tab datos personales del formulario-->
<div class="datosPersonales" >

  <div class="container width-100">

    <div class="row" style="margin-left: 20px;">
        <div class="left" >
            <label>¿Soy Capitan?</label>
        </div>
        <div class="switch pull-left" >
            <input type="radio" class="switch-input input-db" name="swichtCapitan" value="1" id="week" onClick=controlSwichtCapitan() >
            <label for="week" class="switch-label switch-label-off">SI</label>
            <input type="radio" class="switch-input input-db" name="swichtCapitan" value="0" id="month" checked onClick=controlSwichtCapitan()>
            <label for="month" class="switch-label switch-label-on">NO</label>
            <span class="switch-selection"></span>
        </div>
    </div>


    <div class="row no-label">
        <div id="opcionesCapitan" style="display:none" aria-label="..." class="col-1">
            
            <div id="tipoCarrera" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <div>Carrera</div>
                <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(Select2::classname(), [
                    'data' => $tipocarreraLista,
                    'id'=>'idTipoCarrera',
                    'options' => [
                        'placeholder' => 'Elegí una carrera', 'id'=>'idTipocarrera'
                    ],
                    ])->label('Carreras'); ?>
            </div>
            
            <div id="cantidadPeronas" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <div>Cantidad de corredores</div>
                <?= $form->field($equipo, 'cantidadPersonas')->widget(Select2::classname(), [
                'data' => $cantCorredores,
                'id'=>'idParametros',
                'options' => [
                    'placeholder' => 'Cantidad corredores', 'id'=>'idParametrosCantPersonas',
                ],
                ])->label('Cantidad de corredores'); ?>
            </div>


        </div>
    </div>

    <div class="row no-label">
    <div id="opcionesNoSoyCapitan" style="display:block" aria-label="..." class="col-1">
        
        <div id="dniCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <div>DNI capitán</div>
        <?= $form->field($equipo, 'idEquipo')->widget(Select2::classname(), [
            'data' => $equipoLista,
            'id'=>'idEquipo',
            'options' => [
                'placeholder' => 'Ingrese el D.N.I. de su capitan...', 'id'=>'idEquipo',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 5,
            ]
            ]); ?>
        </div>
        
        <div id="nombreCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <div>Nombre capitán</div>
            <?= $form->field($persona, 'nombrePersona')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idNombreCapitan',
                        'readonly' => true,
                        'showToggleAll' => false,
                        'multiple' => true,
                        
                    ],
                    'pluginOptions'=>[
                        'initialize' => false,
                        'placeholder' => 'Nombre del capitan',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/nombrecapitan']),
                        'loadingText' => 'Buscando D.N.I...']
            ])->label('Nombre capitan');
            ?>
        </div>

        
        <div id="tipoDeCarrera" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <div>Tipo de carrera</div>
            <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idTipoDeCarrera',
                        'multiple' => true
                    ],
                    'pluginOptions'=>[
                        'initialize' => false,
                        'placeholder' => 'Tipo de carrera',
                        'depends'=>['idEquipo'],
                        'url'=>Url::to(['inscripcion/tipocarrera']),
                        'loadingText' => 'Buscando D.N.I...']
            ]);
            ?>
        </div>
        
        <div id="cantidadPersonas" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <div>Cantidad de corredores</div>
            <?= $form->field($equipo, 'cantidadPersonas')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idCantidadPersonas',
                        'multiple' => true

                    ],
                    'pluginOptions'=>[
                        'initialize' => false,
                        'placeholder' => 'Cantidad de corredores',
                        'depends'=>['idEquipo'],
                        'id'=>'cantPersonas',
                        'url'=>Url::to(['inscripcion/cantpersonas']),
                        'loadingText' => 'Buscando D.N.I...']
            ]);
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
    <div class="row no-label">
        
        <div id="dniUsuario" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>DNI</div>
            <?= $form->field($usuario, 'dniUsuario')->textInput(['value'=>$user->identity->dniUsuario,'readonly'=> true, 'class' => 'input-db'])->label('')?>
        </div>
        
        <div id="nacionalidadPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>Nacionalidad</div>
            <?= $form->field($persona, 'nacionalidadPersona')->textInput(['maxlength' => true, 'class' => 'input-db', 'placeholder'=>'Nacionalidad']) ?>
        </div>
        
        <div id="nombrePersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>Nombre</div>
            <?= $form->field($persona, 'nombrePersona')->textInput(['maxlength' => true, 'class' => 'input-db','placeholder'=>'Nombre']) ?>
        </div>
        
        <div id="apellidoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <div>Apellido</div>
            <?= $form->field($persona, 'apellidoPersona')->textInput(['maxlength' => true, 'class' => 'input-db','placeholder'=>'Apellido'])?>
        </div>
    </div>
    <div class="row">
        
        <div id="fechaNacPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 no-label">
        <div>Fecha de nacimiento</div>
        <!-- utilizacion de un widget de kartik llamado DatePicker, permite escoger
        una fecha desde un calendario permitiendo tambien seleccionar años o meses
        con una mayor facilidad -->
            <?=  $form->field($persona, 'fechaNacPersona')->textInput(['class'=>'datepicker form-control input-db','id'=>'datepicker', 'placeholder'=>'Fecha de nacimiento']) ?>

        </div>
        
        <div id="sexoPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
        <div>Sexo</div>
            <!-- campo tipo radioButton, con dos opciones: SI o NO -->
            <?= $form->field($persona, 'sexoPersona')->radioList(array('F'=>'Femenino','M'=>'Masculino'))->label('')?>
        </div>
        
        <div id="talleRemera" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 no-label">
        <div>Talle de remera</div>
        <?=$form->field($talleRemera, 'idTalleRemera')->dropDownList($listadoTalles, ['prompt' => 'Talle de remera' ]); ?>
        </div>
    </div>


    </div>

  </div>

</div>

