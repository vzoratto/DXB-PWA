<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Grupocopia */

$this->title = $model->idEquipo;
$this->params['breadcrumbs'][] = ['label' => 'Grupocopias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="grupocopia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idEquipo' => $model->idEquipo, 'idPersona' => $model->idPersona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idEquipo' => $model->idEquipo, 'idPersona' => $model->idPersona], [
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
            'idEquipo',
            'idPersona',
        ],
    ]) ?>

</div>
