<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */
//formulario para que el gestor de alta pagos--------------------------------
?>

<div class="pago-form reglamento-container">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php if ($model->isNewRecord)?>
         <?= $form->field($model, 'dniUsu')->textInput();?>
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
                'minimumInputLength' => 8,
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
        <?php
         echo '<pre>';print_r($usu);echo '</pre>';die();
     ?>
    <?= $form->field($model, 'importePagado')->textInput() ?>

    <?= $form->field($model, 'entidadPago')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'idPersona')->textInput() ?>-->

    <!--<?= $form->field($model, 'importe')->textInput() ?>-->
    
    <!--<?= $form->field($model, 'idEquipo')->textInput() ?>-->
    <?php
      if ($model->isNewRecord) 
         echo $form->field($model, 'imagenComprobante')->fileInput();
         ?>
    <div class="form-group">
    <?php
      if ($model->isNewRecord) 
             echo Html::submitButton('Acreditar pago', ['class' => 'btn btn-success']);
      else	 
		     echo Html::submitButton('Actualizar', ['class' => 'btn btn-success']);
	  ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
