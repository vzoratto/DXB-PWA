<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuesta-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    
        <?= Html::a('Create Respuesta', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Encuestas', ['encuesta/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Preguntas', ['pregunta/index'], ['class' => 'btn btn-default']) ?>

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
                    'value'=>'persona.nombrePersona',
                ],
                [
                    'attribute'=>'idPersona',
                    'label'=>'Apellido',
                    'value'=>'persona.apellidoPersona',
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
    
    
    <hr>
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
                'value'=>'persona.nombrePersona',
            ],
            [
                'attribute'=>'idPersona',
                'label'=>'DNI',
                'value'=>'persona.usuario.dniUsuario',
            ],
            'respValor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
