<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariorol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuariorol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idRol')->textInput() ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
