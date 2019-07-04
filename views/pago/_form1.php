<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */
//formulario para que el gestor de alta pagos--------------------------------
?>

<div class="pago-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
      if ($model->isNewRecord) 
         echo $form->field($model, 'dniUsu')->textInput();
     ?>
    <?= $form->field($model, 'importePagado')->textInput() ?>

    <?= $form->field($model, 'entidadPago')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'idPersona')->textInput() ?>-->

    <!--<?= $form->field($model, 'importe')->textInput() ?>-->
    
    <!--<?= $form->field($model, 'idEquipo')->textInput() ?>-->
    <?= $form->field($model, 'imagenComprobante')->fileInput() ?>

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
