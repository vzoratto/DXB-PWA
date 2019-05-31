<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreEquipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cantidadPersonas')->textInput() ?>

    <?= $form->field($model, 'idTipoCarrera')->textInput() ?>

    <?= $form->field($model, 'deshabilitado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
