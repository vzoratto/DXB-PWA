<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Result */

$this->title = 'Update Result: ' . $model->idResultado;
$this->params['breadcrumbs'][] = ['label' => 'Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idResultado, 'url' => ['view', 'id' => $model->idResultado]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
