<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Crear Usuario';

?>
<div class="usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>
     <h3><?= Html::encode($mensaje) ?></h3>
    <?= $this->render('_form', [
        'model' => $model,
        'mensaje'=>$mensaje,
    ]) ?>

</div>
