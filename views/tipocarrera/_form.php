<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocarrera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipocarrera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcionCarrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reglamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deshabilitado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
