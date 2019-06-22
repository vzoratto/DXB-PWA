<?php

/* ----------------------------------------------------------------------------------------------
-- Permite ver las opciones de respuesta para cada pregunta-
-- Se pueden generar opciones nuevas para preguntas ya generadas y modificar las ya existentes.
-- ----------------------------------------------------------------------------------------------*/
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
<br><br>
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="alert alert-success">

        <!-- En caso de que se haya seleccionado una pregunta, activa la opcion de crear una opcion nueva, caso contrario no se puede -->
        <?php if($pregunta!=null): ?>
            <?= Html::a('Crear Opcion de Respuesta', ['create', 'idPregunta'=>$pregunta->idPregunta], ['class' => 'btn btn-default']) ?>
        <?php endif ?>
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-default']) ?>
   
    <!-- Menu que permite exportar información en varios formatos -->
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider, //utiliza el mismo dataProvider que la grilla, solo que utiliza mas información
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
            'label' => 'Exportar',
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
                'attribute'=>'',
                'label'=>'Tipo',
                'value'=>'pregunta.encuesta.encTipo',
            ],
            [
                'attribute'=>'',
                'label'=>'Encuesta',
                'value'=>'pregunta.encuesta.encTitulo',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Pregunta',
                'value'=>'pregunta.pregDescripcion',
            ],
            'opRespvalor',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
