<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */

$this->title = $model->idPersonaEmergencia;
$this->params['breadcrumbs'][] = ['label' => 'Personaemergencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="personaemergencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPersonaEmergencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPersonaEmergencia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idPersonaEmergencia',
            'nombrePersonaEmergencia',
            'apellidoPersonaEmergencia',
            'telefonoPersonaEmergencia',
            'idVinculoPersonaEmergencia',
        ],
    ]) ?>

</div>
