<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestaopcion */

$this->title = 'Update Respuestaopcion: ' . $model->idRespuestaOpcion;
$this->params['breadcrumbs'][] = ['label' => 'Respuestaopcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespuestaOpcion, 'url' => ['view', 'id' => $model->idRespuestaOpcion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuestaopcion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
