<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = "Datos del corredor eliminado del sistema";

\yii\web\YiiAsset::register($this);
if($mensaje!=''){
    $msg=$mensaje;
}else{
    $msg="";
}
?>
<div class="persona-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>
>

    <?= DetailView::widget([
        'persona' => $persona,
        'attributes' => [
            [  'label'=>'Referencia corredor',
                'attribute'=>'idPersona',
        ],
           // 'idTalleRemera',
            'nombrePersona',
            'apellidoPersona',
            'fechaNacPersona',
            'sexoPersona',
           // 'nacionalidadPersona',
            'telefonoPersona',
            'mailPersona',
            [ 'label'=>'DNI',
                'attribute' => 'idUsuario',
                 'value' => function($persona) {
                     return ($persona->usuario->dniUsuario);
                 },
                ],
            //'idPersonaDireccion',
           // 'idFichaMedica',
            'fechaInscPersona',
           // 'idPersonaEmergencia',
           // 'idResultado',
           // 'donador',
           // 'deshabilitado',
        ],
    ]) ?>
    <br>
    <div class='alert alert-info'>
    <h1><?= Html::encode($msg) ?></h1>
    </div>
</div>
