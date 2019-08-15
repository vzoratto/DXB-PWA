<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Permiso;
use app\models\Estadopagoequipo;
use app\models\Pago;
/* @var $this yii\web\View */
/* @var $model app\models\Estadopagoequipo */

$this->title = "Referencia equipo ".$model->idEquipo;

\yii\web\YiiAsset::register($this);
?>
<div class="estadopagoequipo-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?Php 
        //id1=idEstadoPago, id=idEquipo     
       // echo $model->idEstadoPago;die();
        if($model->idEstadoPago == 2):
             echo Html::a('Envío email', ['enviamail','id1' => $model->idEstadoPago, 'id' => $model->idEquipo], ['class' => 'btn btn-success']);
          ?>
        <?Php endif ?>
       
        <?Php 
        //id1=idEstadoPago, id=idEquipo     
        if(Permiso::requerirRol('administrador')):
        echo Html::a('Eliminar estado pago???', ['delete', 'idEstadoPago' => $model->idEstadoPago, 'idEquipo' => $model->idEquipo], [
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
           // 'idEstadoPago',
            //'idEquipo',
           
           ['label'=>'Nombre del equipo',
            'attribute'=>'nombreEquipo',
            'value'=>function($model){
               return ($model->equipo->nombreEquipo);
             }
           ],
           ['label' => 'DNI capitán',
           'attribute' => 'dniCapitan',
           'value' => function($model) {
               return ($model->equipo->dniCapitan);
              },
          ],
          ['label' => 'Email capitán',
           'attribute' => 'mailusuario',
           'value' => function($model) {
               return ($model->equipo->usuario->mailUsuario);
              }
          ],
          ['label'=>'Importe Pagado',
              'attribute'=>'idEquipo',
           'value'=>function($model){
            return   Pago::sumaEquipo($model->idEquipo);
           }
          ],
           ['label'=>'Estado del pago',   
           'attribute' => 'idEstadoPago',
           'value' => function($model) {
               return ($model->estadoPago->descripcionEstadoPago);
              },
          ],
          ['label'=>'Debe pagar',
            'attribute'=>'importe',
            'hAlign' => 'center',
            "contentOptions" =>["style"=>"color:red;"],
            'value'=>function($model){
                $print='';
                foreach($model->equipo->tipoCarrera->importeinscripcion as $importe){ 
                  $suma=Pago::sumaEquipo($model->equipo->idEquipo);
                  $cant=$model->equipo->cantidadPersonas;
                  $cantper=$importe->importe * $cant;
                  $costo=$cantper -$suma;
                   $print.=$costo;//para importe indcripcion por persona
                   //$print.=$importe->importe;//para importe incripcion por equipo
                } if($print==0){
                    $print="---";
                 }
                 return $print;
            },   
           ],
           ['label'=>'Costo inscripción',
            'attribute'=>'importe',
            'value'=>function($model){
                $print='';
                foreach($model->equipo->tipoCarrera->importeinscripcion as $importe){ 
                    $cant=$model->equipo->cantidadPersonas;
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
             <?php foreach($model->equipo->persona as $pers) :?>
                <tr>
                   <td><?= $pers->nombrePersona." ".$pers->apellidoPersona ?></td>
                   <td><?= $pers->usuario->dniUsuario ?></td>
                   <td><?= $pers->mailPersona ?></td>
            
                </tr>
             <?php endforeach; ?>
       </table> 

</div>
  