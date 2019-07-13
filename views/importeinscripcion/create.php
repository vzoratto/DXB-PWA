<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Importeinscripcion */

$this->title = 'Crear importe inscripción';

?>
<div class="importeinscripcion-create">
<h3><?= 'Ingreso de nuevos valores para los distintos tipos de carrera' ?></h3>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
