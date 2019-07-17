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
  <div class="col-lg-5">
    <h2> <?= "Datos del corredor"?></h2>
    <br>
    <h4 style='color:#3A8816;'><strong><?= Html::encode($this->title)?></strong></h4>
       <ul>
        <li>Nombre corredor: <?= Html::encode($persona->nombrePersona)?> <?= Html::encode($persona->apellidoPersona)?></li>
        <li>Nombre equipo:  <?= Html::encode($equipo->nombreEquipo)?></li>
        <li>Tipo carrera:  <?= Html::encode($tipocarrera->descripcionCarrera)?></li>
        <li>Cantidad personas: <?= Html::encode($tipocarrera->cantidadMaximaCorredores)?> </li>
      </ul>
    </div> 
<?Php $this->title = "Participante DNI ".$usuario1->dniUsuario; ?>
  <div class="col-lg-5">
    <h2> <?= "Datos del participante"?></h2>
    <br>
    <h4 style='color:#3A8816;'><strong><?= Html::encode($this->title)?></strong></h4>
     <ul>
       <li>Nombre participante: <?= Html::encode($persona1->nombrePersona)?> <?= Html::encode($persona1->apellidoPersona)?></li>
     </ul>
     <br>
     <?Php if($grupo1!=null){
        echo "<strong style='color:#D5372F;'>El participante pertenece al equipo ".Html::encode($equipo1->nombreEquipo)."</strong>";
     }else{
        echo "<strong style='color:#3A8816;'>El participante será el nuevo corredor del equipo ".Html::encode($equipo->nombreEquipo)."</strong>";
     }
    ?>
  </div>  
</div>
<br><br>
<div class="row">
    <?= Html::a('Cambiar corredor', ['/equipo/cambiacorredor',$usuario->dniUsuario,$persona->idPersona,$usuario1->dniUsuario,$persona1->idPersona], ['class'=>'btn btn-grande btn-rounded btn-carrera submitbutton width-100']) ?>                 

</div>
</div>