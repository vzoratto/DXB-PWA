<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImporteinscripcionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="importeinscripcion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idImporte') ?>

    <?= $form->field($model, 'importe') ?>

    <?= $form->field($model, 'deshabilitado') ?>

    <?= $form->field($model, 'idTipoCarrera') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
