<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ControlpagoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="controlpago-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idControlpago') ?>

    <?= $form->field($model, 'idPago') ?>

    <?= $form->field($model, 'fechaPago') ?>

    <?= $form->field($model, 'fechachequeado') ?>

    <?= $form->field($model, 'idUsuario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
