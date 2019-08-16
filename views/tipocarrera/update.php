<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocarrera */

$this->title = 'Actualiza Tipo de carrera: ' .$model->descripcionCarrera;

?>
<div class="tipocarrera-update ">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
