<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carrerapersona-form">

    <?php $form = ActiveForm::begin(); ?>
	 <?= $form->field($model ,'retiroKit')->dropDownList( array("1"=>"si","2"=>"no"), ['prompt' => 'Seleccione' ])->label('Retiro Kit'); ?>
	 <?php //echo $form->field($equipo,'nombreEquipo')->textInput(['maxlength' => true])->label('Numero Corredor') ;
	 ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success'],['carrerapersona/index']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
