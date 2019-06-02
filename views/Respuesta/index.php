<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuesta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Respuesta', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRespuesta',
            'respValor',
            'idPregunta',
            'idPersona',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
