<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talleremera */

$this->title = 'Update Talleremera: ' . $model->idTalleRemera;
$this->params['breadcrumbs'][] = ['label' => 'Talleremeras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTalleRemera, 'url' => ['view', 'id' => $model->idTalleRemera]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="talleremera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
