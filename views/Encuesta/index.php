<?php
/* --------------------------------------------------------------------------------------------
--    Vista que muestra el listado de las encuestas cargadas. Podemos publicar la encuesta,  --
--    editarla y ver el formulario completo.
--    Solamente una sola encuesta va a estar publicada. En caso de querer publicar mas de una--
--    al mismo tiempo, hay que modificar 'verencuesta/publicar-encuesta'.
-------------------------------------------------------------------------------------------- */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de Encuestas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Encuesta', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'encTitulo',
            'encDescripcion',
            'encPublica',
            ['attribute'=>'',
                    'format'=>'raw',
                    'headerOptions'=>['style'=>'color:#1369BF'],
                    'contentOptions'=>['style'=>'width:100px;'],
                    'value'=>function($model){
                        return Html::a('Publicar',
                                ['verencuesta/publicar-encuesta',
                                 'idEncuesta'=>$model->idEncuesta
                                ],            
                        );
                 }
            ],            
            ['attribute'=>'',
                    'format'=>'raw',
                    'headerOptions'=>['style'=>'color:#1369BF'],
                    'contentOptions'=>['style'=>'width:120px;'],
                    'value'=>function($model){
                        return Html::a('Ver Encuesta',
                                ['verencuesta/ver-encuesta',
                                 'idEncuesta'=>$model->idEncuesta
                                ],            
                        );
                 }
            ],
            ['attribute'=>'',
                    'format'=>'raw',
                    'headerOptions'=>['style'=>'color:#1369BF'],
                    'contentOptions'=>['style'=>'width:120px;'],
                    'value'=>function($model){
                        return Html::a('Preguntas',
                                ['pregunta/index',
                                 'idEncuesta'=>$model->idEncuesta
                                ],            
                        );
                 }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template'=> '{update}'],           
        ],
    ]); ?>


</div>
