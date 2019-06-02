<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-form">

    <?php $form = ActiveForm::begin(); ?>
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
