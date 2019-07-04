<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
//crea un pago el gestor--------------------------------------------
$this->title = 'Crear Pago';

?>
<div class="pago-create">

      <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form1', [
        'model' => $model,
        
    ]) ?>
</div>
</div>

</div>
