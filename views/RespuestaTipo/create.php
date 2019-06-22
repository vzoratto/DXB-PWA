<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestatipo */

$this->title = 'Crear tipo de respuesta';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de respuesta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestatipo-create">
<br><br>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
