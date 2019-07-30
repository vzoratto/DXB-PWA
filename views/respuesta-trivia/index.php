<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaTriviaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestas correctas de trivias';

?>
<div class="respuesta-trivia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Definir Respuesta Trivia', ['create', 'idPregunta'=>$pregunta['idPregunta']], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Preguntas', ['pregunta/index', 'idPregunta'=>$pregunta['idPregunta']], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Opciones de Respuesta', ['respuesta-opcion/index', 'idPregunta'=>$pregunta['idPregunta']], ['class' => 'btn btn-default']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idRespTrivia',
            [
                'attribute'=>'idPregunta',
                'label'=>'Pregunta',
                'value'=>'pregunta.pregDescripcion',
            ],
            'respTriviaValor',
            // 'idPregunta',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>


</div>
