<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = $model->idPersona;

\yii\web\YiiAsset::register($this);
?>
<div class="persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idPersona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['inscripcion/delete', 'id' => $model->idPersona], [
            'class' => 'btn btn-danger',
            'data' => [
                //'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [  'label'=>'Referencia Persona',
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
