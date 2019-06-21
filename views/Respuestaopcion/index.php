<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaOpcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Opciones de Respuesta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestaopcion-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="alert alert-success">
        <?php if($pregunta!=null): ?>
            <?= Html::a('Crear Opcion de Respuesta', ['create', 'idPregunta'=>$pregunta->idPregunta], ['class' => 'btn btn-default']) ?>
        <?php endif ?>
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-default']) ?>
   

    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'idPregunta',
                'label'=>'Tipo',
                'value'=>'pregunta.encuesta.encTipo',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Titulo de Encuesta',
                'value'=>'pregunta.encuesta.encTitulo',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Descripcion de Encuesta',
                'value'=>'pregunta.encuesta.encDescripcion',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Encuesta publica',
                'value'=>'pregunta.encuesta.encPublica',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Pregunta',
                'value'=>'pregunta.pregDescripcion',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Tipo de Respuesta',
                'value'=>'pregunta.respTipo.respTipoDescripcion',
            ],
            'opRespvalor',
            
        ],
        'dropdownOptions' => [
            'label' => 'Exportar datos',
            'class' => 'btn btn-default'
        ],
    ]); ?>

    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'idRespuestaOpcion',
            // 'idPregunta',
            [
                'attribute'=>'idPregunta',
                'label'=>'Tipo',
                'value'=>'pregunta.encuesta.encTipo',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Encuesta',
                'value'=>'pregunta.encuesta.encTitulo',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Pregunta',
                'value'=>'pregunta.pregDescripcion',
            ],
            'opRespvalor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
