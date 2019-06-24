<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gestores */

$this->title = 'Actualizar: ' . $model->nombreGestor;

?>
<div class="gestores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
