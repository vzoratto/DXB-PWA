<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PreguntaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pregunta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pregunta', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Respuestas', ['respuesta/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPregunta',
            'pregDescripcion',
            'idEncuesta',
            'idRespTipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
