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
<!-- Checkbox donde selecciona si es capitan del equipo o no-->
<div class="row" style="margin-left: 20px;">
    <div class="left db-label" >
        <label>¿Soy Capitan? *</label>
    </div>
    <div class="switch pull-left" >
        <input type="radio" class="switch-input input-db" name="swichtCapitan" value="1" id="week" onClick=controlSwichtCapitan() >
        <label for="week" class="switch-label switch-label-off">SI</label>
        <input type="radio" class="switch-input input-db" name="swichtCapitan" value="0" id="month" checked onClick=controlSwichtCapitan()>
        <label for="month" class="switch-label switch-label-on">NO</label>
        <span class="switch-selection"></span>
    </div>
</div>

<!-- Estas son las opciones que ve si selecciona que es capitan -->

<div class="row db-label">
    <div id="opcionesCapitan" style="display:none" aria-label="..." class="col-1">
        
        <div id="tipoCarrera" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <?= $form->field($tipoCarrera, 'idTipoCarrera')->widget(Select2::classname(), [
                'data' => $tipocarreraLista,
                'id'=>'idTipoCarrera',
                'options' => [
                    'placeholder' => 'Elegí una carrera', 'id'=>'idTipocarrera'
                ],
                ])->label('Carreras *' ); ?>
        </div>
        
        <div id="cantidadPeronas" class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
            <?= $form->field($equipo, 'cantidadPersonas')->widget(Select2::classname(), [
            'data' => $cantCorredores,
            'id'=>'idParametros',
            'options' => [
                'placeholder' => 'Cantidad corredores', 'id'=>'idParametrosCantPersonas',
            ],
            ])->label('Cantidad de corredores *'); ?>
        </div>


    </div>
</div>

<!-- Opciones que visualiza si selecciona que no es capitan -->
<div class="row db-label">
<div id="opcionesNoSoyCapitan" style="display:block" aria-label="..." class="col-1">
    
    <div id="dniCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
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
        ])->label('DNI capitan *'); ?>
    </div>
    
    <div id="nombreCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
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


</div>

</div>
<div class="row db-label">
    
    <div id="dniUsuario" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($usuario, 'dniUsuario')->textInput(['class' => 'input-db','placeholder'=>'DNI invitado','autocomplete'=>'off'])->label('DNI *')?>
    </div>
    
    <div id="nacionalidadPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($persona, 'nacionalidadPersona')->textInput(['maxlength' => true, 'class' => 'input-db', 'placeholder'=>'Nacionalidad']) ?>
    </div>
    
    <div id="nombrePersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($persona, 'nombrePersona')->textInput(['maxlength' => true, 'class' => 'input-db','placeholder'=>'Nombre']) ?>
    </div>
    
    <div id="apellidoPersona" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <?= $form->field($persona, 'apellidoPersona')->textInput(['maxlength' => true, 'class' => 'input-db','placeholder'=>'Apellido'])?>
    </div>
</div>
<div class="row">
    
    <div id="fechaNacPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 db-label">
    <!-- utilizacion de un widget de kartik llamado DatePicker, permite escoger
    una fecha desde un calendario permitiendo tambien seleccionar años o meses
    con una mayor facilidad -->
        <?=  $form->field($persona, 'fechaNacPersona')->textInput(['class'=>'datepicker form-control input-db','id'=>'datepicker', 'placeholder'=>'Fecha de nacimiento']) ?>

    </div>
    
    <div id="sexoPersona" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 db-label">
        <!-- campo tipo radioButton, con dos opciones: SI o NO -->
        <div class="db-label m-0">
            <label id="labelSexoDatoPersonal"class="m-0">Sexo *</label>
          </div>
        <?= $form->field($persona, 'sexoPersona')->radioList(array('F'=>'Femenino','M'=>'Masculino'))->label('')?>
    </div>
    
    <div id="talleRemera" class="col-md-4 col-lg-4 col-sm-4 col-xs-12 db-label">
    <?=$form->field($talleRemera, 'idTalleRemera')->dropDownList($listadoTalles, ['prompt' => 'Talle de remera' ])->label('Talle de remera *'); ?>
    </div>
</div>


</div>

</div>

</div>