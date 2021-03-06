<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LocalidadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idLocalidad') ?>

    <?= $form->field($model, 'idProvincia') ?>

    <?= $form->field($model, 'nombreLocalidad') ?>

    <?= $form->field($model, 'codigoPostal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
