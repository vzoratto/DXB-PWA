<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-form">
<?php
       if($usuario->dniUsuario == $equipo->dniCapitan){
        echo 'Sos capitan del equipo '.Html::encode($equipo->nombreEquipo);
        echo 'DNI '.Html::encode($equipo->dniCapitan);
       }else{
           echo 'Sos integrante del equipo '.Html::encode($equipo->nombreEquipo);
           echo 'DNI'.Html::encode($usuario->dniUsuario);
       }
    ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'importePagado')->textInput(['placeholder'=>'Importe pagado: solo numeros']) ?>

    <?= $form->field($model, 'entidadPago')->textInput(['placeholder'=>'Lugar de pago']) ?>

    <?php
      if ($model->isNewRecord)
		  echo $form->field($model, 'fechaPago')->textInput(['id'=>'pfecha','value'=>date("Y-m-d"), 'readonly'=> true]); 
	  else 
	      echo $form->field($model, 'fechaPago')->textInput(['id'=>'pfecha']);
	  ?>

    <!--<?= $form->field($model, 'fechachequeado')->textInput() ?>-->

   <!-- <?= $form->field($model, 'idPersona')->textInput() ?>-->

    <!--<?= $form->field($model, 'idImporte')->textInput() ?>-->

    <!--<?= $form->field($model, 'idEquipo')->textInput() ?>-->

    <!--<?= $form->field($model, 'idUsuario')->textInput() ?>-->
    <?= $form->field($model, 'imagenComprobante')->fileInput(['placeholder'=>'Ingresa imagen del ticket']) ?>

    <?= 'Costo de inscripcion $'.Html::encode($importecarrera->importe) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
