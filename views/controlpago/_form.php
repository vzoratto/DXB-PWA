<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controlpago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPago')->textInput() ?>

    <?= $form->field($model, 'fechaPago')->textInput() ?>

    <?= $form->field($model, 'fechachequeado')->textInput() ?>

    <?= $form->field($model, 'idUsuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
