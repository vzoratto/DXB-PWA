<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichamedica-form">

<!-- vista del tab datos medicos del formulario-->
<div class="datosMedicos" >
    <div class="row">
        <div id="obraSocial" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <?= $form->field($fichaMedica, 'obraSocial')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div id="peso" class="col-md-3 col-lg-3 col-sm-3 col-xs-6">
            <?= $form->field($fichaMedica, 'peso')->textInput() ?>
        </div>

        <div id="altura" class="col-md-3 col-lg-3 col-sm-3 col-xs-6">
            <?= $form->field($fichaMedica, 'altura')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div id="frecuenciaCardiaca" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <?= $form->field($fichaMedica, 'frecuenciaCardiaca')->textInput() ?>
        </div>
        <div id="idGrupoSanguineo" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <!-- campo tipo select tambien llamado dropDownList, 
            se carga con los datos de la base especificamente de la tabla Grupo Sanguineo-->
            <?= $form->field($fichaMedica, 'idGrupoSanguineo')->dropDownList(
                //se traen los datos de la tabla especificada, el id se lo tomará como valor mientras que el tipo es lo que se mostrará en pantalla para seleccionar 
                    \yii\helpers\ArrayHelper::map(\app\models\GrupoSanguineo::find()->all(),'idGrupoSanguineo','tipoGrupoSanguineo'),
                    ['prompt'=>'Seleccione su grupo sanguineo...'] //texto que se mostrará por defecto hasta que se seleccione un grupo sanguineo
            )->label('Grupo Sanguineo'); ?>
        </div>
        <div id="donador" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <?= $form->field($persona, 'donador')->radioList(array(true=>'Si', false=>'No'))
                                                            ->label('¿Donador de sangre?'); ?>
        </div>
        
    </div>

    <div class="row">
        <div id="evaluacionMedica" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
            <?= $form->field($fichaMedica, 'evaluacionMedica')->radioList(array(true=>'Si', false=>'No'))
                                                            ->label('¿Se ha realizado una evaluación médica en el presente año?'); ?>
        </div>

        <div id="intervencionQuirurgica" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
            <?= $form->field($fichaMedica, 'intervencionQuirurgica')->radioList(array(true=>'Si',false=>'No'))
                                                            ->label('¿Se ha realizado una intervención quirúrgica?'); ?>
        </div>

    </div>
    <div class="row">
        <div id="suplementos" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
        <?= $form->field($fichaMedica, 'suplementos')->radioList(array(true=>'Si',false=>'No'))
                                                        ->label('¿Toma suplementos?'); ?>
        </div>

        <div id="tomaMedicamentos" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
                <?= $form->field($fichaMedica, 'tomaMedicamentos')->radioList(array(true=>'Si',false=>'No'))
                                                                ->label('¿Toma medicamentos?'); ?>
        </div>
    </div>
    <div class="row">
        <div id="observaciones" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <?= $form->field($fichaMedica, 'observaciones')->textInput(['maxlength' => 256]) ?>
        </div>
    </div>
</div>
<div class="form-group" id="botones-atras-siguiente">
</div>



</div>
