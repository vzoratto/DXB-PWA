<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */

$this->title = 'Modificar Pregunta: ' . $model->pregDescripcion;
$this->params['breadcrumbs'][] = ['label' => 'Preguntas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idPregunta, 'url' => ['view', 'id' => $model->idPregunta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pregunta-update reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'encTipo'=>$model->encuesta->encTipo,
        'actualizar'=> true,
    ]) ?>

</div>
