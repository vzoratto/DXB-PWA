<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gruposanguineo */

$this->title = 'Create Gruposanguineo';
$this->params['breadcrumbs'][] = ['label' => 'Gruposanguineos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gruposanguineo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
