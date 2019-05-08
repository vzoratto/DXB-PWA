<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadopagopersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadopagopersonas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadopagopersona-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estadopagopersona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idEstadoPago',
            'idPersona',
            'fechaPago',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
