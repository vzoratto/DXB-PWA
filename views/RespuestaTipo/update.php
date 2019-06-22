<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestatipo */

$this->title = 'Actualizar tipos de respuesta: ' . $model->idRespTipo;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Respuesta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespTipo, 'url' => ['view', 'id' => $model->idRespTipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuestatipo-update container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
