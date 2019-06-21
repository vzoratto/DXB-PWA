<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

$this->title = ' ' . $model->persona->nombrePersona." ".$model->persona->apellidoPersona;
$this->params['breadcrumbs'][] = ['label' => $model->idTipoCarrera, 'url' => ['view', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carrerapersona-update">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
    <?php $form = ActiveForm::begin(); ?>
	 <?= $form->field($model ,'retiraKit')->dropDownList( array("1"=>"si","2"=>"no"), ['prompt' => 'Seleccione' ])->label('Retira Kit'); ?>
	 <?php //echo $form->field($equipo,'nombreEquipo')->textInput(['maxlength' => true])->label('Numero Corredor') ;
	 ?>

    <?= $form->field($model, 'retiraKit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success'],['carrerapersona/index']) ?>
    </div>

    <?php ActiveForm::end(); ?>

