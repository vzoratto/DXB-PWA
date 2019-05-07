<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Localidad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idProvincia')->textInput() ?>

    <?= $form->field($model, 'nombreLocalidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigoPostal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
