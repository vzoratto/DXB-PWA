<?php

/* -------------------------------------------------------------------------------------------------
-- Vista utilizada para crear y modificar opciones de respuesta
-- ------------------------------------------------------------------------------------------------*/
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestaopcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestaopcion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opRespvalor')->textInput(['maxlength' => true, 'autofocus'=>true])->label('Opción:') ?>

    <?= $form->field($model, 'idPregunta')->hiddenInput(['value'=>$pregunta['idPregunta']])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar Cambios', ['class' => 'btn btn-default']) ?>
        <?= Html::a('Cancelar', ['respuestaopcion/index', 'idPregunta'=>$pregunta['idPregunta'] ],['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
