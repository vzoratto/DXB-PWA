<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PagoinscripcionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagoinscripcion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPago') ?>

    <?= $form->field($model, 'importe') ?>

    <?= $form->field($model, 'entidadpago') ?>

    <?= $form->field($model, 'imagencomprobante') ?>

    <?= $form->field($model, 'fechapago') ?>

    <?php // echo $form->field($model, 'pagado') ?>

    <?php // echo $form->field($model, 'idPersona') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
