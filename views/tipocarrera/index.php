<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipocarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipocarreras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipocarrera-index">

  <div class="row mtb-20">

    <div class="col-xs-6 col-md-6 p-0">

      <h1 class="m-0"><?= Html::encode($this->title) ?></h1>

    </div>

    <div class="col-xs-6 col-md-6">

      <?= Html::a('Tipo carrera +', ['create'], ['class' => 'btn btn-success']) ?>

    </div>

  </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTipoCarrera',
            'descripcionCarrera',
            'reglamento',
            'deshabilitado',
            'cantidadMaximaCorredores',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
