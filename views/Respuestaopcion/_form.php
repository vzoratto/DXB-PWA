<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestaopcion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestaopcion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opRespvalor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPregunta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
