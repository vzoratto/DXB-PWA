<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Tipocarrera;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FechacarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fechas de carreras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fechacarrera-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Fechas de carreras', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idFechaCarrera',
            'fechaCarrera',
            'fechaLimiteUno',
            'fechaLimiteDos',
            ['label'=>'Tipo Carrera',
              'attribute'=>'idTipoCarrera',
              'value'=>function($model){
                  return $model->tipoCarrera->descripcionCarrera;
              },
              'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera'),
              'filterInputOptions' => ['prompt' => 'Elije...', 'class' => 'form-control', 'id' => null]
            ],
            ['attribute'=>'deshabilitado',
             'value'=>function($model){
                 return ($model->deshabilitado==0)?'no':'si';
             },
               'filter'=>array('0'=>"no",'1'=>"si"),
               'filterInputOptions' => ['prompt' => 'Elije..', 'class' => 'form-control', 'id' => null]
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{view} {update}',
                ],
        ],
    ]); ?>


</div>
