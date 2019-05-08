<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gestores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gestores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreGestor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidoGestor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefonoGestor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
