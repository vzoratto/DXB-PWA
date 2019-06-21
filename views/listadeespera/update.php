<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Listadeespera */

$this->title = 'Update Listadeespera: ' . $model->idListaDeEspera;
$this->params['breadcrumbs'][] = ['label' => 'Listadeesperas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idListaDeEspera, 'url' => ['view', 'id' => $model->idListaDeEspera]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="listadeespera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
