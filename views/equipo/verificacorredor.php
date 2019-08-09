<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = "Corredor DNI ".$usuario->dniUsuario;
//\yii\web\YiiAsset::register($this);
?>
<div class='reglamento-container'>
    <div class="row">
           <h2> <?= "Informe para verificar el cambio de corredor"?></h2>
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-5 text-center">
           <h2> <?= "Datos del corredor"?></h2>
          <br>
           <h4 style='color:#3A8816;'><strong><?= Html::encode($this->title)?></strong></h4>
             <ul>
               <li>Nombre corredor: <?= Html::encode($persona->nombrePersona)?> <?= Html::encode($persona->apellidoPersona)?></li>
               <li>Nombre equipo:  <?= Html::encode($equipo->nombreEquipo)?></li>
               <li>Tipo carrera:  <?= Html::encode($tipocarrera->descripcionCarrera)?></li>
               <li>Cantidad personas: <?= Html::encode($equipo->cantidadPersonas)?> </li>
              </ul>
        </div> 

    </div>  

   <br><br>
   <div class="rows" style='margin-left:80px;'>
       <?= Html::a('Cambiar corredor', ['/equipo/cambiacorredor',$usuario->dniUsuario,$persona->idPersona], ['class'=>'btn btn-grande btn-rounded btn-carrera submitbutton width-100']) ?>                 

    </div>
  </div>
</div>