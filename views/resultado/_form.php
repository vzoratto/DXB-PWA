<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resultado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resultado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idResultado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
