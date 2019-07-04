<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estadopagoequipo */

$this->title = 'Create Estadopagoequipo';
$this->params['breadcrumbs'][] = ['label' => 'Estadopagoequipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estadopagoequipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
