<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Importeinscripcion */

$this->title = 'Actualizar: ';

?>
<div class="importeinscripcion-update">
<h3><?= 'Se actualizan los campos necesarios con respecto al tipo de carrera'?></h3>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
