<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Importeinscripcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="importeinscripcion-form reglamento-container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'importe')->textInput(['placeholder'=>'Ingresa solo numeros, sin punto ni comas.']) ?>

    <?= $form->field($model, 'deshabilitado')->dropdownList(['0'=>'no','1'=>'si']) ?>

    <!--<?= $form->field($model, 'idTipoCarrera')->textInput() ?>-->
    <?php
         if ($model->isNewRecord){   
            echo $form->field($model, 'idTipoCarrera')->dropDownList($model->carreraDescrip, 
             ['prompt'=>'- Selecciona uno...']);
          }else{
	         echo $form->field($model, 'idTipoCarrera')->dropDownList($model->carreraDescrip,
             ['value' => !empty($model->idTipoCarrera) ? $model->idTipoCarrera :['prompt'=>'Selecciona uno...']]);
         }
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
