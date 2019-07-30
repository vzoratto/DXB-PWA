<?php

use yii\helpers\Html;
use app\models\PreguntaSearch;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTrivia */

$this->title = 'Definir Respuesta Correcta';
$pregunta=PreguntaSearch::findOne($model->idPregunta);
?>
<div class=" reglamento-container">
<div class="respuesta-trivia-create">
    

    <h3><?= Html::encode($this->title) ?></h3>
    <h4>Pregunta: <?= Html::encode($pregunta->pregDescripcion) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
