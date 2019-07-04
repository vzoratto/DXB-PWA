<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */

$this->title = 'Create Pago';

?>
<div class="pago-create">
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd no-label" align="center">
      <img class="center" src="assets/img/logo-color.png" alt="logo color">
      <p><?= Html::encode($this->title) ?></p>

    <?= $this->render('_form', [
        'model' => $model,
        'equipo'=> $equipo,//dniCapitan,idEquipo
        'persona'=> $persona,//idPersona
        'usuario'=> $usuario,//idUsuario, dniUsuario,mailUsuario
        'tipocarrera'=>$tipocarrera,//descripcionCarrera
        'importecarrera'=>$importecarrera,//importe del tipo de carrera
    ]) ?>
</div>
</div>

</div>
