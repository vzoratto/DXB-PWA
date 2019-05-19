<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuesta-opcion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opRespvalor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPregunta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
