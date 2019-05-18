<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Validacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="validacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <?= $form->field($model, 'mailUsuarioValidado')->textInput() ?>

    <?= $form->field($model, 'codigoValidacionMail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigoRecuperarCuenta')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
