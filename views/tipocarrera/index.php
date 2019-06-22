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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tipocarrera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
