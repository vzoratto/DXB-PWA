<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Result */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<br>
<br>
<br>
<br>

<div class="result-form">

    <?php $form = ActiveForm::begin(
            [
                'method'=>'post',
                "action"=>"index.php?r=result%2Fprocesarindividual",
            ]
    ); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Numero Equipo</label>
                    <input type="text" class="form-control" name="numEquipo">

                </div>
                <div class="form-group">
                    <label>Tiempo Llegada</label>
                    <input type="text" class="form-control" name="tiempoLlegada">

                </div>
                <div class="form-group">
                    <label>Respuestas Correctas</label>
                    <input type="text" class="form-control" name="respuestasCorrectas">

                </div>
                <div class="form-group">
                    <label>bolsasCompletas</label>
                    <input type="text" class="form-control" name="bolsasCompletas">

                </div>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>


        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
