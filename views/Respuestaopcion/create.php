<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestaopcion */

$this->title = 'Create Respuestaopcion';
$this->params['breadcrumbs'][] = ['label' => 'Respuestaopcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestaopcion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
