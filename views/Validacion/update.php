<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Validacion */

$this->title = 'Update Validacion: ' . $model->idValidacion;
$this->params['breadcrumbs'][] = ['label' => 'Validacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idValidacion, 'url' => ['view', 'id' => $model->idValidacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="validacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
