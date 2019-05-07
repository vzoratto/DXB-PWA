<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */

$this->title = 'Update Personaemergencia: ' . $model->idPersonaEmergencia;
$this->params['breadcrumbs'][] = ['label' => 'Personaemergencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPersonaEmergencia, 'url' => ['view', 'id' => $model->idPersonaEmergencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personaemergencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
