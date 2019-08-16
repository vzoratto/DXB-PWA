<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocarrera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipocarrera-form reglamento-container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcionCarrera')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'reglamento')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'deshabilitado')->textInput() ?>-->

    <?= $form->field($model, 'cantidadMaximaCorredores')->textInput() ?>

    <div class="form-group">
    <?php
          if ($model->isNewRecord) 
             echo Html::submitButton('Ingresar', ['class' => 'btn btn-success']);
          else	 
		     echo Html::submitButton('Actualizar', ['class' => 'btn btn-success']);
	     ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
