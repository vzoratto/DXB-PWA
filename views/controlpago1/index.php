<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ControlpagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control de pagos';

?>
<div class="controlpago-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idControlpago',
           // 'idPago',
            'fechaPago',
            'fechachequeado',
            ['attribute'=>'idUsuario',
              'value'=>function($model){
                  if(!$model->darusuario){
                    return($model->usuario->idUsuario)?'ninguno':'';
                  }else{
                  return($model->usuario->dniUsuario);}
              },
            ],
                  
              

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
