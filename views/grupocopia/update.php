<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grupocopia */

$this->title = 'Update Grupocopia: ' . $model->idEquipo;
$this->params['breadcrumbs'][] = ['label' => 'Grupocopias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEquipo, 'url' => ['view', 'idEquipo' => $model->idEquipo, 'idPersona' => $model->idPersona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grupocopia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
