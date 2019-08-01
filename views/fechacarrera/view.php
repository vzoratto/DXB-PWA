<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */

$this->title = $model->idFechaCarrera;
$this->params['breadcrumbs'][] = ['label' => 'Fechacarreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fechacarrera-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idFechaCarrera], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idFechaCarrera], [
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
            'idFechaCarrera',
            'fechaCarrera',
            'fechaLimiteUno',
            'fechaLimiteDos',
            'deshabilitado',
            'idTipoCarrera',
        ],
    ]) ?>

</div>
