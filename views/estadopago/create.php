<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estadopago */

$this->title = 'Create Estadopago';
$this->params['breadcrumbs'][] = ['label' => 'Estadopagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadopago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
