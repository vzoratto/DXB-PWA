<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Equipo: ' . $model->nombreEquipo;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEquipo, 'url' => ['view', 'id' => $model->idEquipo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wrap">
    <div class="container">
                
        <div class="equipo-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>