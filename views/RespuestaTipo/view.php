<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestatipo */

$this->title = $model->idRespTipo;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de respuesta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="respuestatipo-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idRespTipo], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php /*echo Html::a('Delete', ['delete', 'id' => $model->idRespTipo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de que quiere borrar este item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idRespTipo',
            'respTipoDescripcion',
        ],
    ]) ?>

</div>
