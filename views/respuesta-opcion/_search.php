<?php
//Vista no utilizada en este proyecto

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestapcion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idRespuestaOpcion') ?>

    <?= $form->field($model, 'opRespvalor') ?>

    <?= $form->field($model, 'idPregunta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
