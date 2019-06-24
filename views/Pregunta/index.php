<?php

// Esta vista renderiza los datos de las preguntas, tanto si pertenecen a una encuesta en particular
// como si son todas las encuestas.
// Contiene acceso a ver las respuesta que se han cargado a cada pregunta de las encuestas


use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PreguntaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $encuesta app\models\Encuesta */

$this->title = 'Preguntas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=" reglamento-container">
    <div class="pregunta-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <hr>
        <div class="alert alert-success">
            
            <?php if ($encuesta!=null): ?>
            <?= Html::a('Create Pregunta', ['create','id'=>$encuesta['idEncuesta']], ['class' => 'btn btn-default']) ?>
            <?php endif ?>
            <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-default']) ?>
            <?= Html::a('Opciones de respuesta', ['respuestaopcion/index'], ['class' => 'btn btn-default']) ?>
            <?= Html::a('Respuestas', ['respuesta/index'], ['class' => 'btn btn-default']) ?>

            <!-- El siguiente widget permite exportar los datos de la grilla que posee la vista a varios tipos de archivos -->
            <?= ExportMenu::widget([
                'dataProvider'=>$dataProvider, //Utiliza el mismo dataProvider de la grilla.
                'columns'=>[
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'idEncuesta',
                        'label'=>'Encuesta',
                        'value'=>'encuesta.encTitulo',
                    ],
                    [
                        'attribute'=>'idEncuesta',
                        'label'=>'Tipo de Encuesta',
                        'value'=>'encuesta.encTipo',
                    ],
                    'pregDescripcion',
                    [
                        'attribute'=>'idRespTipo',
                        'label'=>'Tipo de Respuesta',
                        'value'=>'respTipo.respTipoDescripcion',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_EXCEL => false,
                    ExportMenu::FORMAT_PDF => [
                        'pdfConfig' => [
                            'methods' => [
                                'SetTitle' => 'Preguntas',
                                'SetSubject' => 'Detalle de encuestas y preguntas',
                                'SetHeader' => ['Preguntas de encuestas||Generado el: ' . date("r")],
                                'SetFooter' => ['|Page {PAGENO}|'],
                                ]
                        ]
                    ],
                ],
                'dropdownOptions' => [
                    'label' => 'Exportar',
                    'class' => 'btn btn-default'
                ]
            ]) ?>
            
        </div>

           
            <hr>
            <?php if(isset($encuesta['encTitulo'])): ?>
                <h3>Encuesta: <?= Html::encode($encuesta['encTitulo']) ?></h3>
            <?php endif ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'',
                        'label'=>'Tipo',
                        'value'=>'encuesta.encTipo',
                    ],
                    [
                        'attribute'=>'idEncuesta',
                        'label'=>'Encuesta',
                        'value'=>'encuesta.encTitulo',
                    ],
                    'pregDescripcion',
                    [
                        'attribute'=>'idRespTipo',
                        'label'=>'Tipo de Respuesta',
                        'value'=>'respTipo.respTipoDescripcion',
                    ],
                    ['attribute'=>'',
                            'format'=>'raw',
                            'headerOptions'=>['style'=>'color:#1369BF'],
                            'contentOptions'=>['style'=>'width:120px;'],
                            'value'=>function($model){
                                return Html::a('Opciones respuesta',
                                        ['respuestaopcion/index',
                                        'idPregunta'=>$model->idPregunta
                                        ]
                                );
                        }
                    ],
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

                    ['class' => 'yii\grid\ActionColumn', 'template'=> '{update}'],
                ],
            ]); 
            ?>


    </div>
</div>
