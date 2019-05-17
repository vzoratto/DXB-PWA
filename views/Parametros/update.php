<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Parametros */

$this->title = 'Update Parametros: ' . $model->idParametros;
$this->params['breadcrumbs'][] = ['label' => 'Parametros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idParametros, 'url' => ['view', 'id' => $model->idParametros]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parametros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
