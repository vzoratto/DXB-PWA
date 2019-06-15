<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Persona;

/* @var $this yii\web\View */
/* @var $model app\models\Pagoinscripcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagoinscripcion-form">

    <?php $form = ActiveForm::begin(); 
    //$model_persona=Persona::find($_SESSION['__id']);
    ?>

    <?= $form->field($model, 'importe')->textInput() ?>

    <?= $form->field($model, 'entidadpago')->textInput(['maxlength' => true]) ?>

    <?php
      if ($model->isNewRecord)
		  echo $form->field($model, 'fechapago')->textInput(['value'=>date("Y-m-d"), 'readonly'=> true]); 
	  else 
	      echo $form->field($model, 'fechapago')->textInput();
	?>

    <?= $form->field($model, 'pagado')->textInput() ?>

    <?= $form->field($model, 'idPersona')->textInput() ?>

    <?= $form->field($model, 'imagencomprobante')->fileInput() ?>

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
