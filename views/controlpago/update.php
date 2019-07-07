<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Check: Referencia del pago ' . $model->idPago;
?>
<p>
<?Php
    if($model->chequeado ==1):
         echo '<h3>'.Html::encode($gestor->nombreGestor). ' cuyo DNI '.Html::encode($usuario->dniUsuario).' chequeó este pago</h3>';
 ?> 
 </p> 
 

 <?Php endif ?>
 

<div class="controlpago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gestor'=>$gestor,//idgestor, nombre gestor
        'usuario'=>$usuario,//idUsuario, dniUsuario
    ]) ?>

</div>
