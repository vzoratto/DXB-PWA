<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipocarrera */

$this->title = 'Update Tipocarrera: ' . $model->idTipoCarrera;
$this->params['breadcrumbs'][] = ['label' => 'Tipocarreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipoCarrera, 'url' => ['view', 'id' => $model->idTipoCarrera]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipocarrera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
