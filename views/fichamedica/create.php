<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */

$this->title = 'Create Fichamedica';
$this->params['breadcrumbs'][] = ['label' => 'Fichamedicas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichamedica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
