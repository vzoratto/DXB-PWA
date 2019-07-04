<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ControlpagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control pagos';

?>
<div class="controlpago-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idControlpago',
           ['label'=>'Referencia del pago',
            'attribute'=>'idPago',
            ],
            'fechaPago',
            'fechachequeado',
            ['attribute'=>'chequeado',
             'value'=>function($model){
                 return ($model->chequeado==0)?'no':'si';
             },
               'filter'=>array('0'=>'no','1'=>'si'),
            ],
            //'idGestor',

            [
            'class' => 'yii\grid\ActionColumn',
            'template'=> '{view} {update}',
            ],
        ],
    ]); ?>


</div>
