<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Listadeespera */

$this->title = 'Create Listadeespera';
$this->params['breadcrumbs'][] = ['label' => 'Listadeesperas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listadeespera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
