<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estadopagopersona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estadopagopersona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEstadoPago')->textInput() ?>

    <?= $form->field($model, 'idPersona')->textInput() ?>

    <?= $form->field($model, 'fechaPago')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
