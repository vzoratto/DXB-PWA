<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controlpago-form">
<br>
    <?php
      if($model->chequeado !=1){
        echo '<h3>'.Html::encode($gestor->nombreGestor).' cuyo DNI '.Html::encode($usuario->dniUsuario).' chequeará este pago.</h3>'; 
      }
     ?>
     <br>
     <hr>
    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'idPago')->textInput() ?>-->

    <?php
      if (!$model->isNewRecord)
         echo $form->field($model, 'fechaPago')->textInput(['readonly'=> true]);
      else
		 echo $form->field($model, 'fechaPago')->textInput(['placeholder'=>'Formato aaaa-mm-dd']); 
	  ?>

    <!--<?= $form->field($model, 'fechachequeado')->textInput() ?>-->
    <?php
      if (!$model->isNewRecord)
      echo $form->field($model, 'fechachequeado')->textInput(['value'=>date("Y-m-d"), 'readonly'=> true]); 
     else 
      echo $form->field($model, 'fechachequeado')->textInput(['placeholder'=>'Formato aaaa-mm-dd']);
      ?>
    <!--<?= $form->field($model, 'chequeado')->textInput() ?>-->
    <div class="form-group">
    <?php
      if ($model->isNewRecord) 
             echo Html::submitButton('Ingresar', ['class' => 'btn btn-success']);
      else	
             if($model->chequeado !=1){		  
		         echo Html::submitButton('Chequear', ['class' => 'btn btn-success']);
			       }  
	  ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php if (Yii::$app->session->hasFlash('pagoCheck')): ?>
          <div class="alert alert-success" align="center">
             Check realizado, se envió un mail al participante por la acreditación de pago :)
          </div>
    <?php elseif(Yii::$app->session->hasFlash('pagonoCheck')): ?>
            <div class="alert alert-success" align="center">
             Check no realizado, vuelva a intentarlo :(
            </div>
    <?php endif ?>
</div>
