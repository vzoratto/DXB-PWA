<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestaopcion */

$this->title = 'Crear Opciones de respusta';
$this->params['breadcrumbs'][] = ['label' => 'Respuestaopcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestaopcion-create container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
