<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dniUsuario')->textInput() ?>

    <?= $form->field($model, 'claveUsuario')->passwordinput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'mailUsuario')->textInput(['maxlength' => true])?>

    <!--<?= $form->field($model, 'authkey')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'activado')->textInput() ?>-->
    <?php
         if ($model->isNewRecord){   
            echo $form->field($model, 'idRol')->dropDownList($model->roldescripcion, 
             ['prompt'=>'- Selecciona uno...']);
          }else{
	         echo $form->field($model, 'idRol')->dropDownList($model->roldescripcion,
             ['value' => !empty($model->idRol) ? $model->idRol :['prompt'=>'Selecciona uno...']]);
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
