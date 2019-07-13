<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\controllers\RespuestaopcionController;
use yii\helpers\ArrayHelper;
use app\models\RespuestaTriviaSearch;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTrivia */
/* @var $form yii\widgets\ActiveForm */

$opciones=RespuestaopcionController::listaRespuestaOpcion($model->idPregunta);
$opciones=ArrayHelper::map($opciones, 'opRespvalor', 'opRespvalor');//se obtienen las opciones que estan cargadas
$respuestas=ArrayHelper::map(RespuestaTriviaSearch::findAll(['idPregunta'=>$model->idPregunta]), 'idRespTrivia', 'respTriviaValor');

?>

<div class="respuesta-trivia-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'respTriviaValor')->checkboxList($opciones, ['separator'=>'<br>'])->label(false) ?>

    <?= $form->field($model, 'idPregunta')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-default']) ?>
        <?= Html::a('Cancelar', ['respuesta-trivia/index','idPregunta'=>$model->idPregunta], ['class'=>'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if($respuestas!=[]): ?>
        <div class=" alert-success mb-10">
            <h4 class="ml-20 mt-20 color-grey">Respuestas ya definidas como correctas:</h4>
            <div class="ml-30">
                <?php foreach($respuestas as $unaRespuesta): ?>
                    <span class="color-grey"><?php echo $unaRespuesta; ?></span><br>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>

</div>
