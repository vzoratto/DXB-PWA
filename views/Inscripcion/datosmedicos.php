<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichamedica-form">

<div class="datosMedicos" >

    <div id="obraSocial">
        <?= $form->field($fichaMedica, 'obraSocial')->textInput(['maxlength' => true]) ?>
    </div>

    <div id="peso">
        <?= $form->field($fichaMedica, 'peso')->textInput() ?>
    </div>

    <div id="altura">
        <?= $form->field($fichaMedica, 'altura')->textInput() ?>
    </div>

    <div id="frecuenciaCardiaca">
        <?= $form->field($fichaMedica, 'frecuenciaCardiaca')->textInput() ?>
    </div>

    <div id="idGrupoSanguineo">
        <!-- campo tipo select tambien llamado dropDownList, se carga con los datos de la base especificamente de la tabla Busquedas-->
        <?= $form->field($fichaMedica, 'idGrupoSanguineo')->dropDownList(
                \yii\helpers\ArrayHelper::map(\app\models\GrupoSanguineo::find()->all(),'idGrupoSanguineo','tipoGrupoSanguineo'),
                ['prompt'=>'Seleccione su grupo sanguineo...']
        )->label('Grupo Sanguineo'); ?>
    </div>

    <div id="evaluacionMedica">
        <?= $form->field($fichaMedica, 'evaluacionMedica')->radioList(array(1=>'Si',2=>'No'))
                                                        ->label('¿Se ha realizado una evaluación médica en el presente año?'); ?>
    </div>

    <div id="intervencionQuirurgica">
        <?= $form->field($fichaMedica, 'intervencionQuirurgica')->radioList(array(1=>'Si',2=>'No'))
                                                        ->label('¿Se ha realizado una intervención quirúrgica?'); ?>
    </div>

    <div id="tomaMedicamentos">
    <?= $form->field($fichaMedica, 'tomaMedicamentos')->radioList(array(1=>'Si',2=>'No'))
                                                      ->label('¿Toma medicamentos?'); ?>
    </div>

    <div id="suplementos">
    <?= $form->field($fichaMedica, 'suplementos')->radioList(array(1=>'Si',2=>'No'))
                                                      ->label('¿Toma suplementos?'); ?>
    </div>

    <div id="observaciones">
    <?= $form->field($fichaMedica, 'observaciones')->textInput(['maxlength' => true]) ?>
    </div>
    
</div>

    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>
