<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */

$this->title = 'Actualizar Fecha carrera: ' . $model->idFechaCarrera;

?>
<div class="fechacarrera-update reglamento-conteiner">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
