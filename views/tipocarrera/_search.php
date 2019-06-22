<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipocarreraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipocarrera-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTipoCarrera') ?>

    <?= $form->field($model, 'descripcionCarrera') ?>

    <?= $form->field($model, 'reglamento') ?>

    <?= $form->field($model, 'deshabilitado') ?>

    <?= $form->field($model, 'cantidadMaximaCorredores') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
