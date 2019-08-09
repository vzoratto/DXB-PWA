<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Permiso;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */

$this->title ="Referencia del registro fechas ". $model->idFechaCarrera;

\yii\web\YiiAsset::register($this);
?>
<div class="fechacarrera-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idFechaCarrera], ['class' => 'btn btn-success']) ?>
        <?Php      
        if(Permiso::requerirRol('administrador')):
        echo Html::a('Eliminar fecha???', ['delete', 'id' => $model->idFechaCarrera], [
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
            ['label'=>'Referencia de registro',
            'attribute'=>'idFechaCarrera',
             ],
            'fechaCarrera',
            'fechaLimiteUno',
            'fechaLimiteDos',
            ['label'=>'Tipo Carrera',
              'attribute'=>'idTipoCarrera',
              'value'=>function($model){
                  return $model->tipoCarrera->descripcionCarrera;
              }
            ],
            ['attribute'=>'deshabilitado',
             'value'=>function($model){
                 return ($model->deshabilitado==0)?'no':'si';
             }
            ],
           
        ],
    ]) ?>

</div>
