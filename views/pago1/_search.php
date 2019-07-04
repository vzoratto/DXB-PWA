<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pago-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPago') ?>

    <?= $form->field($model, 'importePagado') ?>

    <?= $form->field($model, 'entidadPago') ?>

    <?= $form->field($model, 'imagenComprobante') ?>

    <?= $form->field($model, 'fechaPago') ?>

    <?php // echo $form->field($model, 'fechachequeado') ?>

    <?php // echo $form->field($model, 'idPersona') ?>

    <?php // echo $form->field($model, 'idImporte') ?>

    <?php // echo $form->field($model, 'idEquipo') ?>

    <?php // echo $form->field($model, 'idUsuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
