<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FechacarreraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fechacarrera-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idFechaCarrera') ?>

    <?= $form->field($model, 'fechaCarrera') ?>

    <?= $form->field($model, 'fechaLimiteUno') ?>

    <?= $form->field($model, 'fechaLimiteDos') ?>

    <?= $form->field($model, 'deshabilitado') ?>

    <?php // echo $form->field($model, 'idTipoCarrera') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
