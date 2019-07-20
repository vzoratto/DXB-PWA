<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichamedica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'obraSocial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'peso')->textInput() ?>

    <?= $form->field($model, 'altura')->textInput() ?>

    <?= $form->field($model, 'frecuenciaCardiaca')->textInput() ?>

    <?= $form->field($model, 'idGrupoSanguineo')->textInput() ?>

    <?= $form->field($model, 'evaluacionMedica')->textInput() ?>

    <?= $form->field($model, 'intervencionQuirurgica')->textInput() ?>

    <?= $form->field($model, 'tomaMedicamentos')->textInput() ?>

    <?= $form->field($model, 'suplementos')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
