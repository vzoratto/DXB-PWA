<?php
//Vista no utilizada para estse proyecto

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuesta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'respValor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPregunta')->textInput() ?>

    <?= $form->field($model, 'idPersona')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
