<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gruposanguineo */

$this->title = 'Update Gruposanguineo: ' . $model->idGrupoSanguineo;
$this->params['breadcrumbs'][] = ['label' => 'Gruposanguineos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGrupoSanguineo, 'url' => ['view', 'id' => $model->idGrupoSanguineo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gruposanguineo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
