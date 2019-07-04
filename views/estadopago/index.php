<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadopagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadopagos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadopago-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Estadopago', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idEstadoPago',
            'descripcionEstadoPago',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
