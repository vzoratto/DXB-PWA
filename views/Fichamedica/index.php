<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Persona;
use app\models\Fichamedica;
use app\models\Gruposanguineo;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FichamedicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichas Medicas';
?>
<div class="fichamedica-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <h2>Total de Fichas Medicas: <?= Html::encode($dataProvider->getCount()) ?></h2>

    <?php  
	
	$gridColumns=[
            ['class' => 'yii\grid\SerialColumn'],
			['label'=>'Corredor',
			   'attribute'=>'apellidoPersona',
				   'value'=> function($model){
					  return ($model->persona->apellidoPersona);
				   }
			],
			['label'=>'Grupo Sanguineo',
			   'attribute'=>'grupoSanguineo',
				   'value'=> function($model){
					   return ($model->grupoSanguineo->tipoGrupoSanguineo);
				   },
			'filter' => ArrayHelper::map(Gruposanguineo::find()->asArray()->all(), 'tipoGrupoSanguineo', 'tipoGrupoSanguineo'),
			],
			['label'=>'Donador',
			   'attribute'=>'donador',
				   'value'=> function($model){
					   return ($model->persona->donador === 1)? 'si':'no';
				   },
			'filter' => ArrayHelper::map(Persona::find()->asArray()->all(), 'donador', 'donador'),
			],
            ['label'=>'Medicamentos',
			   'attribute'=>'tomaMedicamentos',
				   'value'=> function($model){
					   return ($model->tomaMedicamentos === 1)? 'si':'no';
				   },
			'filter' => ArrayHelper::map(Fichamedica::find()->asArray()->all(), 'tomaMedicamentos', 'tomaMedicamentos'),
			],
			['label'=>'Obra Social',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->obraSocial);
				   }
			],
			['label'=>'Peso',
			   'attribute'=>'peso',
				   'value'=> function($model){
					   return($model->peso);
				   }
			],
			['label'=>'Altura',
			   'attribute'=>'altura',
				   'value'=> function($model){
					   return($model->altura);
				   }
			],
			['label'=>'Frecuencia Cardiaca',
			   'attribute'=>'frecuenciaCardiaca',
				   'value'=> function($model){
					   return($model->frecuenciaCardiaca);
				   }
			],
			['label'=>'Intervencion Quirurgica',
			   'attribute'=>'intervencionQuirurgica',
				   'value'=> function($model){
					   return($model->intervencionQuirurgica=== 1)? 'si':'no';
				   },
				   
			'filter' => ArrayHelper::map(Fichamedica::find()->asArray()->all(), 'intervencionQuirurgica', 'intervencionQuirurgica'),
			],
			['label'=>'Suplementos',
			   'attribute'=>'suplementos',
				   'value'=> function($model){
					   return($model->suplementos=== 1)? 'si':'no';
				   },
				   
			'filter' => ArrayHelper::map(Fichamedica::find()->asArray()->all(), 'intervencionQuirurgica', 'intervencionQuirurgica'),
			],
			['label'=>'Observaciones',
			   'attribute'=>'observaciones',
				   'value'=> function($model){
					   return($model->observaciones);
				   }
			], 
    ]; 	
	
	// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
	'filename'=>'DesafioBardas',
	'target' => ExportMenu::TARGET_SELF,
	
	'hiddenColumns'=>[0, 1],
	'exportConfig' => [
        ExportMenu::FORMAT_HTML => false,
        ExportMenu::FORMAT_CSV => false,
        ExportMenu::FORMAT_TEXT => false,
		ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_PDF => [
            'pdfConfig' => [
                'methods' => [
                    'SetTitle' => 'Desafio Bardas',
                    'SetHeader' => ['Desafio Bardas||Generado: ' . date("r")],
                    'SetFooter' => ['|Pagina {PAGENO}|'],
                ]
            ]
        ],
		
    ],
	'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-secondary'
    ]
	
	
]);

// You can choose to render your own GridView separately
echo \kartik\grid\
     GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
	'columns' => $gridColumns,
	'options' => [
		'class' => 'table-responsive',
	],
     ]);
?>
 </p>

</div>

</div>
