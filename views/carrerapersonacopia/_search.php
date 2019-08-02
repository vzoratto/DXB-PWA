<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarrerapersonacopiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carrerapersonacopia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTipoCarrera') ?>

    <?= $form->field($model, 'idPersona') ?>

    <?= $form->field($model, 'reglamentoAceptado') ?>

    <?= $form->field($model, 'retiraKit') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
