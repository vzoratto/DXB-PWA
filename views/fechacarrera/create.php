<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */

$this->title = 'Crear Fechas de carreras';

?>
<div class="fechacarrera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
