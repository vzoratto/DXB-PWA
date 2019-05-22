<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaopcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestaopcions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestaopcion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Respuestaopcion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRespuestaOpcion',
            'opRespvalor',
            'idPregunta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
