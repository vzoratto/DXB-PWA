<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Update Controlpago: ' . $model->idControlpago;
$this->params['breadcrumbs'][] = ['label' => 'Controlpagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idControlpago, 'url' => ['view', 'id' => $model->idControlpago]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="controlpago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
