<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controlpago-form">

    <?php $form = ActiveForm::begin(); ?>

   <!-- <?= $form->field($model, 'idPago')->textInput() ?>-->

    <?= $form->field($model, 'fechaPago')->textInput() ?>

    <?php
      if (!$model->isNewRecord)
		  echo $form->field($model, 'fechachequeado')->textInput(['value'=>date("Y-m-d"), 'readonly'=> true]); 
	  else 
	      echo $form->field($model, 'fechachequeado')->textInput();
	  ?>
      <?php
      if ($model->isNewRecord)
        //echo $form->field($model, 'idUsuario')->textInput() 

       ?>
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
