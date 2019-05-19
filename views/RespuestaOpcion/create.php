<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcion */

$this->title = 'Create Respuesta Opcion';
$this->params['breadcrumbs'][] = ['label' => 'Respuesta Opcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuesta-opcion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
