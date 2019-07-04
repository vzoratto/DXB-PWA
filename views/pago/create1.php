<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */

$this->title = 'Crear Pago';

?>
<div class="pago-create">

      <p><?= Html::encode($this->title) ?></p>

    <?= $this->render('_form1', [
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
