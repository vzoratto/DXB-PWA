<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestatipo */

$this->title = 'Create Respuestatipo';
$this->params['breadcrumbs'][] = ['label' => 'Respuestatipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestatipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
