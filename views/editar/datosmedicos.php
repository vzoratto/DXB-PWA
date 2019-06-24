<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichamedica-form">

    <!-- vista del tab datos medicos del formulario-->
    <div class="datosMedicos" id="tercerStep" >
        <div class="row db-label">
            <div id="obraSocial" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                <?= $form->field($fichaMedica, 'obraSocial')->textInput(['maxlength' => true, 'placeholder' => 'Obra Social'])->label('Obra social') ?>
            </div>

            <div id="peso" class="col-md-3 col-lg-3 col-sm-3 col-xs-6">
                <?= $form->field($fichaMedica, 'peso')->textInput(['placeholder' => 'Peso'])->label('Peso') ?>
            </div>

            <div id="altura" class="col-md-3 col-lg-3 col-sm-3 col-xs-6">
                <?= $form->field($fichaMedica, 'altura')->textInput(['placeholder' => 'Altura'])->label('Altura') ?>
            </div>
        </div>

        <div class="row">
            <div id="frecuenciaCardiaca" class="col-md-4 col-lg-4 col-sm-4 col-xs-6 db-label">
                <?= $form->field($fichaMedica, 'frecuenciaCardiaca')->textInput(['placeholder' => 'Frecuencia Cardíaca'])->label('Frecuencia Cardíaca') ?>
            </div>
            <div id="idGrupoSanguineo" class="col-md-4 col-lg-4 col-sm-4 col-xs-6 db-label">
                <!-- campo tipo select tambien llamado dropDownList,
                se carga con los datos de la base especificamente de la tabla Grupo Sanguineo-->
                <?= $form->field($fichaMedica, 'idGrupoSanguineo')->dropDownList(
                    //se traen los datos de la tabla especificada, el id se lo tomará como valor mientras que el tipo es lo que se mostrará en pantalla para seleccionar
                        \yii\helpers\ArrayHelper::map(\app\models\GrupoSanguineo::find()->all(),'idGrupoSanguineo','tipoGrupoSanguineo'),
                        ['prompt'=>'Grupo sanguíneo'] //texto que se mostrará por defecto hasta que se seleccione un grupo sanguineo
                )->label('Grupo sanguíneo') ?>
            </div>
            <div id="donador" class="col-md-4 col-lg-4 col-sm-4 col-xs-6">
            <div class="db-label m-0">
            <label id="donadorDatosMedicos" class="m-0">¿Donador de sangre?</label>
          </div>                <?= $form->field($persona, 'donador')->radioList(array(true=>'Si', false=>'No'))
                                                                ->label(''); ?>
            </div>

        </div>

        <div class="row db-label">
            <div id="evaluacionMedica" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <div  class="db-label m-0">
            <label id="evaluacionDatosMedicos" class="m-0">¿Se ha realizado una evaluación médica en el presente año?</label>
          </div>            <!-- campo tipo radioButton, con dos opciones: SI o NO -->
                <?= $form->field($fichaMedica, 'evaluacionMedica')->radioList(array(true=>'Si', false=>'No'))
                                                                ->label(''); ?>
            </div>

            <div id="intervencionQuirurgica" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <div class="db-label m-0">
            <label id="intervencionDatosMedicos" class="m-0">¿Se ha realizado una intervención quirúrgica?</label>
          </div>            <!-- campo tipo radioButton, con dos opciones: SI o NO -->
                <?= $form->field($fichaMedica, 'intervencionQuirurgica')->radioList(array(true=>'Si',false=>'No'))
                                                                ->label(''); ?>
            </div>

        </div>
        <div class="row">
            <div id="suplementos" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <div class="db-label m-0">
            <label id="suplementosDatosMedicos" class="m-0">¿Toma suplementos?</label>
          </div>            <!-- campo tipo radioButton, con dos opciones: SI o NO -->
            <?= $form->field($fichaMedica, 'suplementos')->radioList(array(true=>'Si',false=>'No'))
                                                            ->label(''); ?>
            </div>

            <div id="tomaMedicamentos" class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <div class="db-label m-0">
            <label id="tomaMedicamentosDatosMedicos" class="m-0">¿Toma medicamentos?</label>
          </div>                    <!-- campo tipo radioButton, con dos opciones: SI o NO -->
                    <?= $form->field($fichaMedica, 'tomaMedicamentos')->radioList(array(true=>'Si',false=>'No'))
                                                                    ->label(''); ?>
            </div>
        </div>
        <div class="row db-label">
            <div id="observaciones" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($fichaMedica, 'observaciones')->textInput(['maxlength' => 256])->label('Observaciones') ?>
            </div>
        </div>
    </div>
    </div>