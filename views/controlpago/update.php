<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Check: Referencia del pago ' . $model->idPago;

?>
<div class="controlpago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gestor'=>$gestor,//idgestor, nombre gestor
        'usuario'=>$usuario,//idUsuario, dniUsuario
    ]) ?>

</div>
