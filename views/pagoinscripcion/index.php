<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PagoinscripcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagoinscripcions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagoinscripcion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pagoinscripcion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idPago',
            'importe',
            'entidadpago',
            'fechapago',
            'pagado',
            ['attribute'=>'idPersona',
              'value'=>function($model){
                  return $model->persona->nombrePersona;
              }
            ],
            'imagencomprobante:image',
            ['label'=>'Imagen ticket',
             'attribute'=>'imagencomrobante',
             'format'=>'html',
             'value'=>function($model){
                 return yii\bootstrap\Html::img($model->imagencomprobante,['width'=>'150']); 
             }

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
