<?php
/* ------------------------------------------------------------------------------------------------
-- Muestra las respuestas dadas a cada pregunta de cada encuesta.
-- En esta caso no se pueden crear, editar ni eliminar respuestas, ya que estas son generadas
-- por los usuarios, ya sea en la inscripcion como en respuestas de las trivias, segun sea el caso.
---------------------------------------------------------------------------------------------------*/


use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestas';
?>
<div class="respuesta-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr> 
    <div class="alert alert-success">
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-default']) ?>

        <!-- Esporta los datos de la grilla al formato que se elija -->
        <?= ExportMenu::widget([
            'dataProvider'=>$dataProvider, //Utiliza el mismo dataProvider de la grilla.
            'columns'=>[
                ['class' => 'yii\grid\SerialColumn'],
                'idRespuesta',
                [
                    'attribute'=>'idPregunta',
                    'label'=>'Encuesta',
                    'value'=>'pregunta.encuesta.encTitulo',
                ],
                [
                    'attribute'=>'idPregunta',
                    'label'=>'Descripcion Encuesta',
                    'value'=>'pregunta.encuesta.encDescripcion',
                ],
                [
                    'attribute'=>'idPregunta',
                    'label'=>'Pregunta',
                    'value'=>'pregunta.pregDescripcion',
                ],
                [
                    'attribute'=>'idPersona',
                    'label'=>'Nombre',
                    'value'=>'persona.nombreCompleto',
                ],
                
                [
                    'attribute'=>'idPersona',
                    'label'=>'Sexo',
                    'value'=>'persona.sexoPersona',
                ],
                [
                    'attribute'=>'idPersona',
                    'label'=>'Nacionalidad',
                    'value'=>'persona.nacionalidadPersona',
                ],
                [
                    'attribute'=>'idPersona',
                    'label'=>'DNI',
                    'value'=>'persona.usuario.dniUsuario',
                ],
                'respValor',
            ],
            'dropdownOptions' => [
                'label' => 'Exportar datos',
                'class' => 'btn btn-default'
            ]
        ]) ?>
    
    </div>
    <?php if(isset($pregunta['pregDescripcion'])): ?>
        <h3>Pregunta: <?= Html::encode($pregunta['pregDescripcion']) ?></h3>
    <?php endif ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'idRespuesta',
            [
                'attribute'=>'',
                'label'=>'Encuesta',
                'value'=>'pregunta.encuesta.encTitulo',
            ],
            [
                'attribute'=>'',
                'label'=>'Descripcion Encuesta',
                'value'=>'pregunta.encuesta.encDescripcion',
            ],
            [
                'attribute'=>'idPregunta',
                'label'=>'Pregunta',
                'value'=>'pregunta.pregDescripcion',
            ],
            [
                'attribute'=>'idPersona',
                'label'=>'Nombre',
                'value'=>'persona.nombreCompleto',
            ],
            [
                'attribute'=>'',
                'label'=>'DNI',
                'value'=>'persona.usuario.dniUsuario',
            ],
            'respValor',

        ],
    ]); ?>

</div>
