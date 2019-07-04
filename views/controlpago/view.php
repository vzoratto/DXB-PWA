<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title ='Referencia: '. $model->idControlpago;

\yii\web\YiiAsset::register($this);
?>
<div class="controlpago-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idControlpago], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idControlpago], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idControlpago',
           // 'idPago',
            'fechaPago',
            'fechachequeado',
            ['attribute'=>'idUsuario',
              'value'=>function($model){
                  if(!$model->darusuario){
                    return($model->darusuario==false)?'':'ninguno';
                  }else{
                  return($model->usuario->dniUsuario);}
              },
            ],
        ],
    ]) ?>

</div>
