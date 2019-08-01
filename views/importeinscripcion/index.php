<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Tipocarrera;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImporteinscripcionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Importe de la inscripción';

?>
<div class="importeinscripcion-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear importe inscripción', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idImporte',
            'importe',
            ['attribute'=>'idTipoCarrera',
            'value'=>function($model){
                return ($model->tipoCarrera->descripcionCarrera);
            },
            'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera'),
           ],
           ['attribute'=>'deshabilitado',
             'value'=>function($model){
                 return ($model->deshabilitado==0)?'no':'si';
             },
               'filter'=>array('0'=>"no",'1'=>"si"),
            ],
           [
            'class' => 'yii\grid\ActionColumn',
            'template'=> '{view} {update}',
            ],
        ],
    ]); ?>


</div>
