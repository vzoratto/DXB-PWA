<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dniUsuario')->textInput() ?>

    <?= $form->field($model, 'claveUsuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailUsuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idRol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
