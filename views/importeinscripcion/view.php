<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\TipoCarrera;
use app\models\Permiso;

/* @var $this yii\web\View */
/* @var $model app\models\Importeinscripcion */

$this->title = 'Vista previa del registro';

\yii\web\YiiAsset::register($this);
?>
<div class="importeinscripcion-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idImporte], ['class' => 'btn btn-success']) ?>
        <?Php      
        if(Permiso::requerirRol('administrador')):
        echo Html::a('Eliminar pago???', ['delete', 'id' => $model->idImporte], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que quiere eliminar este registro???',
                'method' => 'post',
            ],
        ]); ?>
        <?Php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idImporte',
            'importe',
            
            ['attribute'=>'idTipoCarrera',
            'value'=>function($model){
                return ($model->tipoCarrera->descripcionCarrera);
            },
           // 'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera'),
           ],
           ['attribute'=>'deshabilitado',
             'value'=>function($model){
                 return ($model->deshabilitado==0)?'no':'si';
             },
               'filter'=>array('0'=>'no','1'=>'si'),
            ],
        ],
    ]) ?>

</div>
