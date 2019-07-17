

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pago */
//vista luego de realizar el pago por el participante-------------------------------
$this->title = 'Detalle del pago ingresado';

\yii\web\YiiAsset::register($this);
?>
<div class="pago-view reglamento-container">
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd1 no-label" align="center">
      <img class="center" src="assets/img/logo-color.png" alt="logo color">
    <p><?= Html::encode($this->title) ?></p>

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
                return ($model->importe->importe);

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
             Realizaste un pago total, recuerda que en 48 horas h&aacute;biles se te acreditar&aacute; el pago :)
          </div>
        <?php elseif(Yii::$app->session->hasFlash('pagoParcial')): ?>
        <div class="alert alert-success" align="center">
             Realizaste un pago parcial, recuerda que en 48 horas h&aacute;biles se te acreditar&aacute; el pago :)
          </div>
        <?php endif ?>
    </div>
  </div>
</div>