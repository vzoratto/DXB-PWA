<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fichamedica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($fichaMedica, 'obraSocial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($fichaMedica, 'peso')->textInput() ?>

    <?= $form->field($fichaMedica, 'altura')->textInput() ?>

    <?= $form->field($fichaMedica, 'frecuenciaCardiaca')->textInput() ?>

    <?= $form->field($fichaMedica, 'idGrupoSanguineo')->textInput() ?>

    <?= $form->field($fichaMedica, 'evaluacionMedica')->textInput() ?>

    <?= $form->field($fichaMedica, 'intervencionQuirurgica')->textInput() ?>

    <?= $form->field($fichaMedica, 'tomaMedicamentos')->textInput() ?>

    <?= $form->field($fichaMedica, 'suplementos')->textInput() ?>

    <?= $form->field($fichaMedica, 'observaciones')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
