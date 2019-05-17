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
        <!-- campo tipo select tambien llamado dropDownList, 
        se carga con los datos de la base especificamente de la tabla Grupo Sanguineo-->
        <?= $form->field($fichaMedica, 'idGrupoSanguineo')->dropDownList(
            //se traen los datos de la tabla especificada, el id se lo tomará como valor mientras que el tipo es lo que se mostrará en pantalla para seleccionar 
                \yii\helpers\ArrayHelper::map(\app\models\GrupoSanguineo::find()->all(),'idGrupoSanguineo','tipoGrupoSanguineo'),
                ['prompt'=>'Seleccione su grupo sanguineo...'] //texto que se mostrará por defecto hasta que se seleccione un grupo sanguineo
        )->label('Grupo Sanguineo'); ?>
    </div>

    <div id="evaluacionMedica">
    <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
        <?= $form->field($fichaMedica, 'evaluacionMedica')->radioList(array(true=>'Si', false=>'No'))
                                                        ->label('¿Se ha realizado una evaluación médica en el presente año?'); ?>
    </div>

    <div id="intervencionQuirurgica">
    <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
        <?= $form->field($fichaMedica, 'intervencionQuirurgica')->radioList(array(true=>'Si',false=>'No'))
                                                        ->label('¿Se ha realizado una intervención quirúrgica?'); ?>
    </div>

    <div id="tomaMedicamentos">
    <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
    <?= $form->field($fichaMedica, 'tomaMedicamentos')->radioList(array(true=>'Si',false=>'No'))
                                                      ->label('¿Toma medicamentos?'); ?>
    </div>

    <div id="suplementos">
    <!-- campo tipo radioButton, con dos opciones: SI o NO --> 
    <?= $form->field($fichaMedica, 'suplementos')->radioList(array(true=>'Si',false=>'No'))
                                                      ->label('¿Toma suplementos?'); ?>
    </div>

    <div id="observaciones">
    <?= $form->field($fichaMedica, 'observaciones')->textInput(['maxlength' => 256]) ?>
    </div>
    
</div>

    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>
