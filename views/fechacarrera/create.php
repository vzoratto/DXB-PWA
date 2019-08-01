<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fechacarrera */

$this->title = 'Create Fechacarrera';
$this->params['breadcrumbs'][] = ['label' => 'Fechacarreras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fechacarrera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
