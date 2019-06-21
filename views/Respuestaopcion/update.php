<?php
/* ---------------------------------------------------------------------------------------------
-- Vista que nos permite la actualización de las opciones de respuestas
-- ----------------------------------------------------------------------------------------------*/
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestaopcion */
/* @var $pregunta app\models\Pregunta */

$this->title = 'Modificar opción de respuesta: ' . $model->opRespvalor;
$this->params['breadcrumbs'][] = ['label' => 'Respuestaopcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespuestaOpcion, 'url' => ['view', 'id' => $model->idRespuestaOpcion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuestaopcion-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pregunta'=>$pregunta,
    ]) ?>

</div>
