

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
//vista luego de realizar el pago por el gestor-------------------------------
$this->title = 'Detalle del pago ingresado';

\yii\web\YiiAsset::register($this);
?>
<div class="pago-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'idPago',
            'importePagado',
            'entidadPago',
            
            ['attribute'=>'idPersona',
            'value'=>function($model){
                return ($model->persona->nombreCompleto);

                },
            ],
            ['label'=>'Nombre de Equipo',
            'attribute'=>'idEquipo',
            'value'=>function($model){
                return($model->equipo->nombreEquipo);
               },
           ],
           ['label'=>'Costo inscripcion',
            'attribute'=>'idImporte',
            'value'=>function($model){
                $importe=$model->importe->importe;
                $cantpers=$model->equipo->cantidadPersonas;
                return $costo=$importe * $cantpers;
                //return ($model->importe->importe);
                },
            ],
            ['label'=>'Imagen ticket',
            'attribute'=>'imagenComrobante',
            'format'=>'html',
            'value'=>function($model){
                return yii\bootstrap\Html::img($model->imagenComprobante,['width'=>'80']); 
            }
           ],
    ],
    ]) ?>
        <?php if (Yii::$app->session->hasFlash('pagoTotal')): ?>
          <div class="alert alert-success" align="center">
             Ingresaste un pago total, recuerda chequear el pago el pago :)
          </div>
        <?php elseif(Yii::$app->session->hasFlash('pagoParcial')): ?>
        <div class="alert alert-success" align="center">
            Ingresaste un pago parcial, recuerda chequear el pago :)
          </div>
        <?php else: (Yii::$app->session->hasFlash('nopago')) ?>
          <div class="alert alert-success" align="center">
             Hubo un inconveniente, por favor vuelve a intentarlo o comunícate con el administrador :)
          </div>
        <?php endif ?>
    </div>
  </div>
</div>