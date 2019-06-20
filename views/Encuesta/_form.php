<?php

// Renderiza la generación de la encuesta

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-form">
    
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
    <div class="row">
        <div class="left" >
            <!-- Este switch nos permite darle respuestas correctas a las preguntas para poder comparar después  -->
            <label>¿Que deseas generar?</label>
        </div>
        <div class="switch pull-left" >
            <input type="radio" class="switch-input input-db" name="encTipo" value="trivia" id="encTipoTrivia" onClick=myFunction() >
            <label for="encTipoTrivia" class="switch-label switch-label-off">Trivia</label>
            <input type="radio" class="switch-input input-db" name="encTipo" value="encuesta" id="encTipoEncuesta" checked onClick=myFunction()>
            <label for="encTipoEncuesta" class="switch-label switch-label-on">Encuesta</label>
            <span class="switch-selection"></span>
        </div>
    </div>
    </div>
    <div class=" form-group">
        <?= $form->field($model, 'encTitulo')->textInput() ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'encDescripcion')->textInput(['maxlength' => true]) ?>
    </div>
        <?= $form->field($model, 'encPublica')->hiddenInput(['value'=>0])->label(false) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Siguiente', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
