<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vinculopersona */

$this->title = 'Update Vinculopersona: ' . $model->idVinculo;
$this->params['breadcrumbs'][] = ['label' => 'Vinculopersonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idVinculo, 'url' => ['view', 'id' => $model->idVinculo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vinculopersona-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
