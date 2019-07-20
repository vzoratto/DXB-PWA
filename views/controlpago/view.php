<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Permiso;
/* @var $this yii\web\View */
/* @var $model app\models\Controlpago */

$this->title = 'Chequear pago realizado';

\yii\web\YiiAsset::register($this);
?>
<div class="controlpago-view reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
    <?php 
   // echo '<pre>';print_r($model);echo '</pre>';die();
    if($model->chequeado ==1):
        echo '<h3>'.Html::encode($gestor->nombreGestor). ' cuyo DNI '.Html::encode($usuario->dniUsuario).' chequeó este pago</h3>';
     ?> 
     </p> 
     <p>
    <?Php else:
            echo Html::a('Chequear pago', ['update', 'id' => $model->idControlpago], ['class' => 'btn btn-success']);
        ?>
    </p>
     <?Php endif ?>
     <p>
     <?Php      
        if(Permiso::requerirRol('administrador')):
        echo Html::a('Eliminar chequeado??', ['delete', 'id' => $model->idControlpago], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); ?>
        </p>
        <?Php endif ?>
    
    <br>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idControlpago',
            ['label'=>'Referencia del pago',
             'attribute'=>'idPago',
            ],

            'fechaPago',
            'fechachequeado',
            //'chequeado',
            ['attribute'=>'chequeado',
             'value'=>function($model){
                 return ($model->chequeado==0)?'no':'si';
             },
               //'filter'=>array('0'=>'no','1'=>'si'),
            ],
           // 'idGestor',
        ],
    ]) ?>

</div>
