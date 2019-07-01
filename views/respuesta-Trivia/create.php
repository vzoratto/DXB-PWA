<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaTrivia */

$this->title = 'Definir Respuesta Correcta';
// $this->params['breadcrumbs'][] = ['label' => 'Respuesta Trivias', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class=" reglamento-container">
<div class="respuesta-trivia-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
