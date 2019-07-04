<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estadopagoequipo */

$this->title = 'Update Estadopagoequipo: ' . $model->idEstadoPago;
$this->params['breadcrumbs'][] = ['label' => 'Estadopagoequipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEstadoPago, 'url' => ['view', 'idEstadoPago' => $model->idEstadoPago, 'idEquipo' => $model->idEquipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estadopagoequipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
