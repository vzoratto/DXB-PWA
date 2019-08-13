<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = "Datos del corredor";

\yii\web\YiiAsset::register($this);
?>
<div class="persona-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a('Actualizar', ['update', 'id' => $model->idPersona], ['class' => 'btn btn-success']) ?>-->
        <?= Html::a('1-Eliminación completa', ['delete', 'id' => $model->idPersona], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])?>
        <?= Html::a('2-Elimina corredor', ['delete1', 'id' => $model->idPersona], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])."(1) y (2) Solo se eliminará el registro si hubo un error en la inscripción. "?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [  'label'=>'Referencia corredor',
                'attribute'=>'idPersona',
        ],
           // 'idTalleRemera',
            'nombrePersona',
            'apellidoPersona',
            'fechaNacPersona',
           // 'sexoPersona',
           // 'nacionalidadPersona',
            'telefonoPersona',
            'mailPersona',
            [ 'label'=>'DNI',
                'attribute' => 'idUsuario',
                 'value' => function($model) {
                     return ($model->usuario->dniUsuario);
                 },
                ],
            //'idPersonaDireccion',
           // 'idFichaMedica',
            //'fechaInscPersona',
           // 'idPersonaEmergencia',
           // 'idResultado',
           // 'donador',
           // 'deshabilitado',
        ],
    ]) ?>

</div>
