<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestatipo */

$this->title = 'Update Respuestatipo: ' . $model->idRespTipo;
$this->params['breadcrumbs'][] = ['label' => 'Respuestatipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRespTipo, 'url' => ['view', 'id' => $model->idRespTipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="respuestatipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
