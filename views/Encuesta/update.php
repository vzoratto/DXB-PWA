<?php
//Permite la modificacion del titulo y descripcion de las encuestas/trivias

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */

$this->title = 'Actualizar '.$model->encTipo.': ';
$this->params['breadcrumbs'][] = ['label' => 'Encuestas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idEncuesta, 'url' => ['view', 'id' => $model->idEncuesta]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="">
    
<div class="container">

    <div class="encuesta-update reglamento-container">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
</div>
