<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Create Controlpago';
$this->params['breadcrumbs'][] = ['label' => 'Controlpagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="controlpago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
