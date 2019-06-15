<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

$this->title = 'Datos de ' . $model->persona->nombrePersona." ".$model->persona->apellidoPersona;
?>
<div class="carrerapersona-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formpersona', [ 
        'model' => $model,
    ]) ?>

</div>
