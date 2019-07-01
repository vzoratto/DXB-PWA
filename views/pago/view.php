<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */

$this->title = $model->idPago;

\yii\web\YiiAsset::register($this);
?>
<div class="pago-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php $model1=$model;?>
        <?= Html::a('Chequear', ['controlpago/view', 'id' => $model->idPago], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idPago], [
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
            'idPago',
            'importePagado',
            'entidadPago',
            
            ['attribute'=>'idPersona',
            'value'=>function($model){
                return ($model->persona->nombrePersona);

                },
            ],
            //'idImporte',
            ['label'=>'Nombre de Equipo',
            'attribute'=>'idEquipo',
            'value'=>function($model){
                return($model->equipo->nombreEquipo);
            },
        ],
        'imagenComprobante:image',
    ],
    ]) ?>

</div>
