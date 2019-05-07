<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personadireccion */

$this->title = 'Update Personadireccion: ' . $model->idPersonaDireccion;
$this->params['breadcrumbs'][] = ['label' => 'Personadireccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPersonaDireccion, 'url' => ['view', 'id' => $model->idPersonaDireccion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personadireccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
