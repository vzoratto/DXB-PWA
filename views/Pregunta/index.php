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
    <hr>
    <h3>Encuesta: <?= Html::encode($encuesta['encTitulo']) ?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPregunta',
            'pregDescripcion',
            'idEncuesta',
            ['attribute'=>'',
                    'format'=>'raw',
                    'headerOptions'=>['style'=>'color:#1369BF'],
                    'contentOptions'=>['style'=>'width:120px;'],
                    'value'=>function($model){
                        return Html::a('Respuestas',
                                ['respuesta/index',
                                 'idPregunta'=>$model->idPregunta
                                ]
                        );
                 }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
