<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Result */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numEquipo')->textInput() ?>

    <?= $form->field($model, 'tiempoLlegada')->textInput() ?>

    <?= $form->field($model, 'respuestasCorrectas')->textInput() ?>

    <?= $form->field($model, 'bolsasCompletas')->textInput() ?>

    <?= $form->field($model, 'penalizacionBolsa')->textInput() ?>

    <?= $form->field($model, 'trivia')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'categoria')->textInput() ?>

    <?= $form->field($model, 'cantPersonas')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
