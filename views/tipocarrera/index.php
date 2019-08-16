<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipocarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de carreras';

?>
<div class="tipocarrera-index reglamento-container">

  <div class="row mtb-20">

    <div class="col-xs-6 col-md-6 p-0">

      <h1 class="m-0"><?= Html::encode($this->title) ?></h1>

    </div>

    <div class="col-xs-6 col-md-6">

      <?= Html::a('Tipo carrera +', ['create'], ['class' => 'btn btn-success']) ?>

    </div>

  </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idTipoCarrera',
            'descripcionCarrera',
           // 'reglamento',
            //'deshabilitado',
            'cantidadMaximaCorredores',

            ['class' => 'yii\grid\ActionColumn',
            'header' => 'Acciones',
                  'contentOptions'=>
          ['style'=>'width: 10%;'],
                    'template'=>'{view} {update}',
            
           ],
        ],
    ]); ?>


</div>
