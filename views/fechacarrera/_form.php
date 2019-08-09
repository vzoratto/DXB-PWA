<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fechacarrera-form reglamento-container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fechaCarrera')->textInput(['placeholder'=>'Formato aaaa-mm-dd']) ?>

    <?= $form->field($model, 'fechaLimiteUno')->textInput(['placeholder'=>'Formato aaaa-mm-dd']) ?>

    <?= $form->field($model, 'fechaLimiteDos')->textInput(['placeholder'=>'Formato aaaa-mm-dd']) ?>

    <?= $form->field($model, 'deshabilitado')->dropdownList(['0'=>'no','1'=>'si']) ?>

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
