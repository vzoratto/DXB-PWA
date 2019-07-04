<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estadopago */

$this->title = 'Update Estadopago: ' . $model->idEstadoPago;
$this->params['breadcrumbs'][] = ['label' => 'Estadopagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEstadoPago, 'url' => ['view', 'id' => $model->idEstadoPago]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estadopago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
