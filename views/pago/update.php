<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */

$this->title = 'Actualiza pago referencia: ' . $model->idPago;

?>
<div class="pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
       
    ]) ?>

</div>
