<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fechacarrera-form reglamento-container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fechaCarrera')->textInput() ?>

    <?= $form->field($model, 'fechaLimiteUno')->textInput() ?>

    <?= $form->field($model, 'fechaLimiteDos')->textInput() ?>

    <?= $form->field($model, 'deshabilitado')->textInput() ?>

    <?= $form->field($model, 'idTipoCarrera')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
