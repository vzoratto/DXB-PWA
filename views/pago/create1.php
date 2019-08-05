<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
//crea un pago el gestor--------------------------------------------
$this->title = 'Acreditar pago';

?>
<div class="pago-create">

      <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
        'lista'=>$lista,
        'usuario'=>$usuario,
        'equipo'=>$equipo,
        'persona'=>$persona,
    ]) ?>
</div>
</div>

</div>
