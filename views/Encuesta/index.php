<?php
/* --------------------------------------------------------------------------------------------
--    Vista que muestra el listado de las encuestas cargadas. Podemos publicar la encuesta,  --
--    editarla y ver el formulario completo.
--    Solamente una sola encuesta y una trivia van a estar publicadas. En caso de querer publicar mas de una--
--    al mismo tiempo, hay que modificar 'verencuesta/publicar-encuesta'.
-------------------------------------------------------------------------------------------- */

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;



/* @var $this yii\web\View */
/* @var $searchModel app\models\EncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de Encuestas y Trivias';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <br><br>
    <div class="encuesta-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <hr>
        <div class="alert alert-success">
            <?= Html::a('Crear Encuesta', ['create'], ['class' => 'btn btn-default d-inline']) ?>
            <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-default d-inline']) ?>

            <!-- Genera el menu para la descarga de los datos del grid -->
            <?= ExportMenu::widget([
                'dataProvider' => $dataProvider, //utiliza el mismo dataprovider de la grilla
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    'idEncuesta',
                    'encTipo',
                    'encTitulo',
                    'encDescripcion',
                    'encPublica',
                    
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_EXCEL => false,
                    ExportMenu::FORMAT_PDF => [
                        'pdfConfig' => [
                            'methods' => [
                                'SetTitle' => 'Encuestas',
                                'SetSubject' => 'Detalle de encuestas ',
                                'SetHeader' => ['Encuestas||Generado el: ' . date("r")],
                                'SetFooter' => ['|Page {PAGENO}|'],
                                ]
                        ]
                    ],
                ],

                'dropdownOptions' => [
                    'label' => 'Exportar datos',
                    'class' => 'btn btn-default',
                ],
                
            ])
            ?>  
        </div>  
        
        <!-- La siguiente grilla muestra los datos en pantalla -->
        <?= GridView::widget([
            'dataProvider' => $dataProvider, //utiliza el mismo dataprovider del ExportMenu
            'filterModel' => $searchModel,
            
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'encTipo',
                'encTitulo',
                'encDescripcion',
                'encPublica',
                
                ['attribute'=>'',
                        'format'=>'raw',
                        'headerOptions'=>['style'=>'color:#1369BF'],
                        'contentOptions'=>['style'=>'width:100px;'],
                        'value'=>function($model){
                            return Html::a('Publicar', //Publica la encuesta o trivia que se desea mostrar
                                    [
                                        'verencuesta/publicar-encuesta',
                                        'idEncuesta'=>$model->idEncuesta
                                    ]
                            );
                    }
                ],            
                ['attribute'=>'',
                        'format'=>'raw',
                        'headerOptions'=>['style'=>'color:#1369BF'],
                        'contentOptions'=>['style'=>'width:120px;'],
                        'value'=>function($model){
                            return Html::a('Ver Encuesta', //muestra como quedara la encuesta publicada
                                    [
                                        'verencuesta/ver-encuesta',
                                        'idEncuesta'=>$model->idEncuesta
                                    ]
                            );
                    }
                ],
                ['attribute'=>'',
                        'format'=>'raw',
                        'headerOptions'=>['style'=>'color:#1369BF'],
                        'contentOptions'=>['style'=>'width:120px;'],
                        'value'=>function($model){
                            return Html::a('Preguntas', //muestra las preguntas de la encuesta que se esta seleccionando
                                    ['pregunta/index',
                                    'idEncuesta'=>$model->idEncuesta
                                    ]
                            );
                    }
                ],           
                ['class' => 'yii\grid\ActionColumn', 'template'=> '{update}'],           
            ],
        ]); ?>
    </div>
</div>

