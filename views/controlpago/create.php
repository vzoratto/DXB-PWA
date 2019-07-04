<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Crear Control pago';

?>
<h3><?= 'Solo se dará un alta si y solo si surge un inconveniente.' ?></h3>
<div class="controlpago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
