<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */

$this->title = $model->idEquipo;
\yii\web\YiiAsset::register($this);
?>
<div class="equipo-view reglamento-container">

<div class="col-lg-5">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idEquipo',
            //'nombreEquipo',
			['label'=>'Nombre Equipo',
			   'attribute'=>'nombreEquipo',
			   'value'=> function($model){
					   return($model->nombreEquipo);
				   }
			],
			['label'=>'Cantidad de Corredores',
			   'attribute'=>'cantidadPersonas',
			   'value'=> function($model){
					   return($model->cantidadPersonas);
				   }
			],
			
        ],
    ]) ?>
</div>
<div class="col-lg-5">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idEquipo',
            //'nombreEquipo',
			['label'=>'Capitan ',
			   'attribute'=>'nombreEquipo',
			   'value'=> function($model){
					   return($model->dniCapitan);
				   }
			],
			['label'=>'corredor',
			   'attribute'=>'corredor2',
			   'value'=> function($model){
					   return($model->grupo->persona->idPersona);
				   }
			],
			['label'=>'corredor',
			   'attribute'=>'corredor3',
			   'value'=> function($model){
					   return($model->dniCapitan);
				   }
			],
			['label'=>'corredor',
			   'attribute'=>'corredor4',
			   'value'=> function($model){
					   return($model->dniCapitan);
				   }
			],
			
        ],
    ]) ?>
</div>

</div>