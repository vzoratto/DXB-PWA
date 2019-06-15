<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="left" >
            //Este switch nos permite darle respuestas correctas a las preguntas para poder comparar después 
            <label>¿Que deseas generar?</label>
        </div>
        <div class="switch pull-left" >
            <input type="radio" class="switch-input input-db" name="switchTrivia" value="1" id="enc" onClick=myFunction() >
            <label for="enc" class="switch-label switch-label-off">Encuesta</label>
            <input type="radio" class="switch-input input-db" name="switchTrivia" value="0" id="triv" checked onClick=myFunction()>
            <label for="triv" class="switch-label switch-label-on">Trivia</label>
            <span class="switch-selection"></span>
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
