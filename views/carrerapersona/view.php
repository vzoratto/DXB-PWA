<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

\yii\web\YiiAsset::register($this);
?>
<div class="row">
<div class="col-lg-6">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
		['label' => 'Fecha de Nacimiento',
                'attribute' => 'edad',
                'value' => function($model) {
                    return ($model->persona->fechaNacPersona);
                }
            ],
			['label' => 'Telefono',
                'attribute' => 'telefonoPersona',
                'value' => function($model) {
                    return ($model->persona->telefonoPersona);
                }
            ],
			['label'=>'Mail',
			   'attribute'=>'mail',
				   'value'=> function($model){
					   return($model->persona->mailPersona);
				   }
			],
			['label'=>'Direccion',
			   'attribute'=>'idPersonaDireccion',
				   'value'=> function($model){
					   return($model->persona->personaDireccion->direccionUsuario);
				   }
			],
			['label'=>'Localidad',
			   'attribute'=>'idPersonaDireccion',
				   'value'=> function($model){
					   return($model->persona->personaDireccion->localidad->nombreLocalidad);
				   }
			],
			
			
        ],
    ])
    ?>
	</div>
	<div class="col-lg-6">
	<?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
			['label'=>'Grupo Sanquineo',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->persona->fichaMedica->grupoSanguineo->tipoGrupoSanguineo);
				   }
			],
			['label'=>'Donador',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return ($model->persona->donador === 1)? 'si':'no';
				   }
			],
			['label'=>'Medicamentos',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return ($model->persona->fichaMedica->tomaMedicamentos === 1)? 'si':'no';
				   }
			],
			['label'=>'Obra Social',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->persona->fichaMedica->obraSocial);
				   }
			],
			['label'=>'Contacto de Emergencia',
			   'attribute'=>'idPersonaEmergencia',
				   'value'=> function($model){
					   return($model->persona->personaEmergencia->telefonoPersonaEmergencia);
				   }
			],
			
        ],
    ])
    ?>
	</div>
	<div class="col-lg-4">

	</div>
</div>
