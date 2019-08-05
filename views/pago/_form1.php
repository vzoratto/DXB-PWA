<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Usuario;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */
//formulario para que el gestor de alta pagos--------------------------------
?>

<div class="pago-form reglamento-container">

 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   <?php if ($model->isNewRecord):?>
         
    <div class="row db-label">
        <div id="opcionesNoSoyCapitan" style="display:block" aria-label="..." class="col-1">

            <div id="dniUsuario" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <?= $form->field($model, 'dniUsu')->widget(Select2::classname(), [
                 'data' => $lista,
                 'id'=>'idUsuario',
                 'options' => [
                 'placeholder' => 'Ingrese el D.N.I. corredor...', 'id'=>'idUsuario',
                  ],
                 'pluginOptions' => [
                  'allowClear' => true,
                 'minimumInputLength' => 8,
                 ]
               ])->label('DNI corredor '); ?>
            </div>

            <div id="nombrePersona" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <?= $form->field($persona, 'nombrePersona')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idNombre',
                        'readonly' => true,
                        'showToggleAll' => false,
                        'multiple' => true,

                    ],
                    'pluginOptions'=>[
                        'initialize' => false,
                        'placeholder' => 'Nombre del corredor',
                        'depends'=>['idUsuario'],
                        'url'=>Url::to(['pago/nombrecorredor']),
                        'loadingText' => 'Buscando ...']
                       ])->label('Nombre corredor');
                  ?>
            </div>
    
            <div id="dniCapitan" class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                <?= $form->field($equipo, 'dniCapitan')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'disabled' => true,
                    'options' => [
                        'id' => 'idDniCapitan',
                        'readonly' => true,
                        'showToggleAll' => false,
                        'multiple' => true,

                    ],
                    'pluginOptions'=>[
                        'initialize' => false,
                        'placeholder' => 'DNI capitan',
                        'depends'=>['idUsuario'],
                        'url'=>Url::to(['pago/dnicapitan']),
                        'loadingText' => 'Buscando ...']
                       ])->label('DNI capitan');
                  ?>
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
                        'placeholder' => 'Nombre capitan',
                        'depends'=>['idUsuario'],
                        'url'=>Url::to(['pago/nombrecapitan']),
                        'loadingText' => 'Buscando ...']
                       ])->label('Nombre capitan');
                  ?>
            </div>
        </div>   
    </div>
 <?php endif ?>
    <div class="row db-label">
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
</div>
    <?php ActiveForm::end(); ?>

</div>
