<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */

$this->title = 'Update Fichamedica: ' . $model->idFichaMedica;
$this->params['breadcrumbs'][] = ['label' => 'Fichamedicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFichaMedica, 'url' => ['view', 'id' => $model->idFichaMedica]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fichamedica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
