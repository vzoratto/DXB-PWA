<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Validacion */

$this->title = 'Create Validacion';
$this->params['breadcrumbs'][] = ['label' => 'Validacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="validacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
