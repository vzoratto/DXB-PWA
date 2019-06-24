<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */

$this->title = 'Crear corredor';

?>
<div class="persona-create">

    <h1><?= Html::encode($this->title) ?></h1>
      <h3><?= Html::encode($mensaje)?></h3>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
