<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Parametros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parametros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cantidadCorredores')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
