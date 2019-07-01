<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\controllers\RespuestaopcionController;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTrivia */
/* @var $form yii\widgets\ActiveForm */

$opciones=RespuestaopcionController::listaRespuestaOpcion($model->idPregunta);
$opciones=ArrayHelper::map($opciones, 'opRespvalor', 'opRespvalor');
?>
<pre><?php print_r($opciones) ?></pre>
<div class="respuesta-trivia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'respTriviaValor')->checkboxList($opciones, ['separator'=>'<br>'])->label(false) ?>

    <?= $form->field($model, 'idPregunta')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
