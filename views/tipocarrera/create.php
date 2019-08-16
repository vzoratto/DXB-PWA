<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocarrera */

$this->title = 'Crear Tipo de carrera';

?>
<div class="tipocarrera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
