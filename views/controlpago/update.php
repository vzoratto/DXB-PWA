<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Chequear pago referencia: ' . $model->idControlpago;

?>
<div class="controlpago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
