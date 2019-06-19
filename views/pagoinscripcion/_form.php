<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Pagoinscripcion */
/* @var $form yii\widgets\ActiveForm */

    
    echo "Numero DNI corredor: ". Yii::$app->user->identity->dniUsuario;
?>

<div class="pagoinscripcion-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
    
    ?>

    <?= $form->field($model, 'importe')->textInput() ?>

    <?= $form->field($model, 'entidadpago')->textInput(['maxlength' => true]) ?>

    <?php
      if ($model->isNewRecord)
		  echo $form->field($model, 'fechapago')->textInput(['value'=>date("Y-m-d"), 'readonly'=> true]); 
	  else 
	      echo $form->field($model, 'fechapago')->textInput();
	  ?>

    <!--<?= $form->field($model, 'pagado')->textInput() ?>-->

    <!--<?= $form->field($model, 'idPersona')->textInput() ?>-->
    
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
