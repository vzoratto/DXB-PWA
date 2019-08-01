<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Permiso;
/* @var $this yii\web\View */
/* @var $model app\models\Pago */
//vista donde el gestor puede consultar el pago y chequear-------------------------- 
$this->title = 'Detalle del pago ingresado';

\yii\web\YiiAsset::register($this);
?>
<div class="pago-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php 
        if($controlpago->chequeado==0){
            echo Html::a('Chequear', ['controlpago/view', 'id' => $model->idPago], ['class' => 'btn btn-success']);
            echo Html::a('Actualizar', ['update', 'id' => $model->idPago], ['class' => 'btn btn-success']);
            
        }else{
            echo Html::a('Ver pago chequeado', ['controlpago/view', 'id' => $model->idPago], ['class' => 'btn btn-success']);
        }
        ?>
        <?Php      
        if(Permiso::requerirRol('administrador')):
        echo Html::a('Eliminar pago???', ['delete', 'id' => $model->idPago], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de querer eliminar este registro???',
                'method' => 'post',
            ],
        ]); ?>
        <?Php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label'=>'Referencia pago',
            'attribute'=>'idPago',
            ],
            ['label'=>'Nombre de Equipo',
            'attribute'=>'idEquipo',
            'value'=>function($model){
                return($model->equipo->nombreEquipo);
               },
           ],
            ['attribute'=>'idPersona',
            'value'=>function($model){
                return ($model->persona->nombreCompleto);
                },
            ],
           'importePagado',
            'entidadPago',
           ['label'=>'Costo inscripcion',
            'attribute'=>'idImporte',
            'value'=>function($model){
                return ($model->importe->importe);
                },
            ],
        'imagenComprobante:image',
       ],
    ]) ?>

</div>
