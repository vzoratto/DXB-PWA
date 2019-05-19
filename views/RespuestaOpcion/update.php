<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcion */

$this->title = 'Update Respuesta Opcion: ' . $model->idRespuestaOpcion;
$this->params['breadcrumbs'][] = ['label' => 'Respuesta Opcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespuestaOpcion, 'url' => ['view', 'id' => $model->idRespuestaOpcion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuesta-opcion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
