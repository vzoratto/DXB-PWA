<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Encuesta */


$this->title = 'Crear nueva Encuesta/Trivia';
// $this->params['breadcrumbs'][] = ['label' => 'Encuestas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <div class="container">
        
        <div class="encuesta-create reglamento-container">
        
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
