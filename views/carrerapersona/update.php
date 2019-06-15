<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

$this->title = ' ' . $model->persona->nombrePersona." ".$model->persona->apellidoPersona;
$this->params['breadcrumbs'][] = ['label' => $model->idTipoCarrera, 'url' => ['view', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carrerapersona-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
