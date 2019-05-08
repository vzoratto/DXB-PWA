<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estadopagopersona */

$this->title = 'Create Estadopagopersona';
$this->params['breadcrumbs'][] = ['label' => 'Estadopagopersonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadopagopersona-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
