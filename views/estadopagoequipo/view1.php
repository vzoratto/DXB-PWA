<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Permiso;
use app\models\Pago;
/* @var $this yii\web\View */
/* @var $model app\models\Estadopagoequipo */

$this->title = "Referencia equipo ".$model->idEquipo;

\yii\web\YiiAsset::register($this);
?>
<div class="estadopagoequipo-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Envía email', ['enviamail','id1'=>"",'id' => $model->idEquipo], ['class' => 'btn btn-success']) ?>
        <?Php 
        //id1=idEstadoPago, id=idEquipo     
        if(Permiso::requerirRol('administrador')):
        echo Html::a('Desvincular equipo???', ['delete1', 'idEquipo' => $model->idEquipo], [
            'class' => 'btn btn-danger',
            'data' => [
                //'confirm' => 'El equipo se desvincula de la carrera???',
                'method' => 'post',
            ],
        ]); ?>
        <?Php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'idEstadoPago',
            //'idEquipo',
           ['label'=>'Nombre del equipo',
            'attribute'=>'nombreEquipo',
            'value'=>function($model){
               return ($model->nombreEquipo);
             }
           ],
           ['label' => 'DNI capitán',
           'attribute' => 'dniCapitan',
           'value' => function($model) {
               return ($model->dniCapitan);
              },
          ],
          ['label' => 'Email capitán',
           'attribute' => 'mailusuario',
           'value' => function($model) {
               return ($model->usuario->mailUsuario);
              }
          ],
          ['label'=>'Importe Pagado',
            'attribute'=>'idEquipo',
           'value'=>function($model){
            return   Pago::sumaEquipo($model->idEquipo)==0?"0":"";
           }
          ],
          ['label'=>'Estado pago',   
           'attribute' => 'estadopago',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
           'value' =>function($model){
            return   $model='impago'; 
           } 
          ],
           ['label'=>'Costo inscripción',
            'attribute'=>'importe',
            'value'=>function($model){
                $print='';
                foreach($model->tipoCarrera->importeinscripcion as $importe){ 
                   $print.=$importe->importe;
                }
            return $print;
            },   
           ], 
        ],
    ]) ?>
       <table class="table table-bordered table-striped  detail-view">
             <tr>
                <th>Integrantes del equipo </th>
                <th>DNI </th>
                <th>Email </th>
             </tr>
             <?php foreach($model->persona as $pers) :?>
                <tr>
                   <td><?= $pers->nombrePersona." ".$pers->apellidoPersona ?></td>
                   <td><?= $pers->usuario->dniUsuario ?></td>
                   <td><?= $pers->mailPersona ?></td>
                </tr>
             <?php endforeach; ?>
       </table> 

</div>
  