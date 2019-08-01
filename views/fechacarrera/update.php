<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */

$this->title = 'Update Fechacarrera: ' . $model->idFechaCarrera;
$this->params['breadcrumbs'][] = ['label' => 'Fechacarreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFechaCarrera, 'url' => ['view', 'id' => $model->idFechaCarrera]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fechacarrera-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
