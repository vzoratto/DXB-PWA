<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagos recibidos';

?>
<div class="pago-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label'=>'Referencia pago',
             'attribute'=>'idPago',
            ],
            'importePagado',
            'entidadPago',
            
            ['attribute'=>'idPersona',
            'value'=>function($model){
                return ($model->persona->nombreCompleto);

                },
            ],
            ['attribute'=>'chequeado',
             'value'=>function($model){
                 return ($model->chequeado==0)?'no':'si';
             },
               'filter'=>array('0'=>'no','1'=>'si'),
            ],
            ['label'=>'Imagen ticket',
             'attribute'=>'imagenComrobante',
             'format'=>'html',
             'value'=>function($model){
                 return yii\bootstrap\Html::img($model->imagenComprobante,['width'=>'100']); 
             }
            ],
            //'idImporte',
            //'idEquipo',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{view} {update}',
                ],
        ],
    ]); ?>


</div>
