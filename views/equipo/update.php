<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = 'Equipo: ' . $model->nombreEquipo;

?>
<div class="wrap">
    <div class="container">
                
        <div class="equipo-update">
        <h2><?= Html::encode('Cambia nombre del equipo') ?></h2>
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>