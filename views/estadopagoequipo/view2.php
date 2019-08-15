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
        <?= Html::a('Envía email', ['enviamailactiva','id' => $model->idEquipo], ['class' => 'btn btn-success']) ?>
        <?Php 
        //id1=idEstadoPago, id=idEquipo     
       // if(Permiso::requerirRol('administrador')):
        echo Html::a('Activar equipo???', ['activar', 'idEquipo' => $model->idEquipo], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'El equipo se activa al evento???',
                'method' => 'post',
            ],
        ]); ?>
        <?Php //endif ?>
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
            "contentOptions" =>["style"=>"color:red;"],
           'value'=>function($model){
            return   Pago::sumaEquipo($model->idEquipo)==0?"0":"";
           }
          ],
          ['label'=>'Estado pago',   
           'attribute' => 'estadopago',
           'hAlign' => 'center',
           "contentOptions" =>["style"=>"color:red;"],
           'value' =>function($model){
            return   $model='impago'; 
           } 
          ],
           ['label'=>'Costo inscripción',
            'attribute'=>'importe',
            'value'=>function($model){
                $print='';
                foreach($model->tipoCarrera->importeinscripcion as $importe){ 
                    $cant=$model->cantidadPersonas;
                    $costo=$importe->importe * $cant;
                     $print.=$costo;//para importe indcripcion por persona
                     //$print.=$importe->importe;//para importe incripcion por equipo
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
             <?php foreach($participantesEquipo as $participante) :?>
                <tr>
                   <td><?= $participante->persona->nombrePersona." ".$participante->persona->apellidoPersona ?></td>
                   <td><?= $participante->persona->usuario->dniUsuario ?></td>
                   <td><?= $participante->persona->mailPersona ?></td>
                </tr>
             <?php endforeach; ?>
       </table> 


       <?php if(Yii::$app->session->hasFlash('email')): ?>
            <div class="alert alert-success" align="center">
             El email fue enviado sin problemas :)
            </div>
      <?php elseif(Yii::$app->session->hasFlash('nousu')): ?>
            <div class="alert alert-success" align="center">
             Hubo un problema, parece que el usuario no existe :(
            </div>
        <?php endif ?>
  
</div>
