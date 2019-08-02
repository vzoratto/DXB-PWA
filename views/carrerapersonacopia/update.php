<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersonacopia */

$this->title = 'Update Carrerapersonacopia: ' . $model->idTipoCarrera;
$this->params['breadcrumbs'][] = ['label' => 'Carrerapersonacopias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipoCarrera, 'url' => ['view', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="carrerapersonacopia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
