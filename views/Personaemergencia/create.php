<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */

$this->title = 'Create Personaemergencia';
$this->params['breadcrumbs'][] = ['label' => 'Personaemergencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personaemergencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
