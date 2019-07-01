<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTrivia */

$this->title = 'Update Respuesta Trivia: ' . $model->idRespTrivia;
$this->params['breadcrumbs'][] = ['label' => 'Respuesta Trivias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespTrivia, 'url' => ['view', 'id' => $model->idRespTrivia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuesta-trivia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
