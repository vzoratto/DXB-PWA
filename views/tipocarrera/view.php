<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Permiso;
/* @var $this yii\web\View */
/* @var $model app\models\Tipocarrera */

$this->title = 'Tipo de carrera: ' .$model->descripcionCarrera;

\yii\web\YiiAsset::register($this);
?>
<div class="tipocarrera-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idTipoCarrera], ['class' => 'btn btn-success']) ?>
        <?Php      
        if(Permiso::requerirRol('administrador')):
        echo  Html::a('Eliminar ???', ['delete', 'id' => $model->idTipoCarrera], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de querer eliminar este registro???',
                'method' => 'post',
            ],
        ]); ?>
        <?Php endif ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idTipoCarrera',
            'descripcionCarrera',
            //'reglamento',
           // 'deshabilitado',
            'cantidadMaximaCorredores',
        ],
    ]) ?>

</div>
