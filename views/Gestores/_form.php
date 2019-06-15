<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gestores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gestores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreGestor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidoGestor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefonoGestor')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'idUsuario')->textInput() ?>-->
    <?php
         if ($model->isNewRecord){   
            echo $form->field($model, 'idUsuario')->dropDownList($model->dniusuarios, 
             ['prompt'=>'- Selecciona uno...']);
          }else{
	         echo $form->field($model, 'idUsuario')->dropDownList($model->dniusuarios,
             ['value' => !empty($model->idUsuario) ? $model->idUsuario :['prompt'=>'Selecciona uno...']]);
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
