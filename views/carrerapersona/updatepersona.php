<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Datos Participante: ' . $model->nombrePersona.' '.$model->apellidoPersona;

?>
<div class="persona-update reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
