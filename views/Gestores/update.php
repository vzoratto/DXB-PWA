<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gestores */

$this->title = 'Update Gestores: ' . $model->idGestor;
$this->params['breadcrumbs'][] = ['label' => 'Gestores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGestor, 'url' => ['view', 'id' => $model->idGestor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gestores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
