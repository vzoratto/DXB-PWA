<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pagoinscripcion */

$this->title = 'Update Pagoinscripcion: ' . $model->idPago;
$this->params['breadcrumbs'][] = ['label' => 'Pagoinscripcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPago, 'url' => ['view', 'id' => $model->idPago]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pagoinscripcion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
