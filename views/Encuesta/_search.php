<?php

// No se ha utilizado en este proyecto

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EncuestaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idEncuesta') ?>

    <?= $form->field($model, 'encTitulo') ?>

    <?= $form->field($model, 'encDescripcion') ?>

    <?= $form->field($model, 'encPublica') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
