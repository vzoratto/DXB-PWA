<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTipo */

$this->title = 'Create Respuesta Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Respuesta Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuesta-tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
