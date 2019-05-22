<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTipo */

$this->title = 'Update Respuesta Tipo: ' . $model->idRespTipo;
$this->params['breadcrumbs'][] = ['label' => 'Respuesta Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespTipo, 'url' => ['view', 'id' => $model->idRespTipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuesta-tipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
