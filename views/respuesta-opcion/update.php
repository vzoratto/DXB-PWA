<?php
/* ---------------------------------------------------------------------------------------------
-- Vista que nos permite la actualización de las opciones de respuestas
-- ----------------------------------------------------------------------------------------------*/
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcion */
/* @var $pregunta app\models\Pregunta */

$this->title = 'Modificar opción de respuesta: ' . $model->opRespvalor;

?>
<div class="respuestaopcion-update reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pregunta'=>$pregunta,
        'encTipo'=>$encTipo
    ]) ?>

</div>
