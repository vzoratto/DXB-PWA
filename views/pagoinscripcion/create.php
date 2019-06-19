<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pagoinscripcion */

$this->title = 'Create Pagoinscripcion';
$this->params['breadcrumbs'][] = ['label' => 'Pagoinscripcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagoinscripcion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       
    ]) ?>

</div>
