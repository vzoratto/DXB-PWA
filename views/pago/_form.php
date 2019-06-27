<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */

?>
<?php
       if($usuario->dniUsuario == $equipo->dniCapitan){
        echo 'Sos capitan del equipo '.Html::encode($equipo->nombreEquipo);
        echo 'DNI '.Html::encode($equipo->dniCapitan);
       }else{
           echo 'Sos integrante del equipo '.Html::encode($equipo->nombreEquipo);
           echo 'DNI'.Html::encode($usuario->dniUsuario);
       }
    ?>
<div class="pago-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'importePagado')->textInput() ?>

    <?= $form->field($model, 'entidadPago')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'idPersona')->textInput() ?>-->

    <!--<?= $form->field($model, 'idImporte')->textInput() ?>-->

    <!--<?= $form->field($model, 'idEquipo')->textInput() ?>-->
    <?= $form->field($model, 'imagenComprobante')->fileInput(['placeholder'=>'Ingresa imagen del ticket']) ?>

   <?= 'Costo de inscripcion $'.Html::encode($importecarrera->importe) ?>
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
