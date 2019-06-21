<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Gruposanguineo;
use app\models\Talleremera;
use app\models\Tipocarrera;
use app\models\Carrerapersona;
use app\models\Usuario;
use app\models\Equipo;
use app\models\Persona;
use app\models\Estadopagopersona;
use app\models\Estadopago;
use app\models\PersonaSearch;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard; 
use kartik\tabs\TabsX;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ficha Medica ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichamedica-index">
<h1> <br> </h1>

	  
	 <?php
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Corredor',
               // 'class' => ExpandRowColumn::class,
                'attribute' => 'apellidoPersona',
				'value' => function($model) {
                    return ($model->apellidoPersona.' '.$model->nombrePersona );
                },
              //  'column_id' => 'column-info',
              //  'url' => Url::to(['view']),
            ],
            ['label'=>'Grupo Sanguineo',
			   'attribute'=>'grupoSanguineo',
				   'value'=> function($model){
					   return($model->fichaMedica->grupoSanguineo->tipoGrupoSanguineo);
				   },
				   'filter' => ArrayHelper::map(Persona::find()->asArray()->all(), 'idPersona', 'grupoSanguineo'),
			],
			['label'=>'Donador',
			   'attribute'=>'donador',
				   'value'=> function($model){
					   return ($model->donador === 1)? 'si':'no';
				   },
				   'filter' => ArrayHelper::map(Persona::find()->asArray()->all(), 'idPersona', 'donador'),
			],
			['label'=>'Medicamentos',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return ($model->fichaMedica->tomaMedicamentos === 1)? 'si':'no';
				   }
			],
			['label'=>'Obra Social',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->obraSocial);
				   }
			],
			['label'=>'Peso',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->peso);
				   }
			],
			['label'=>'Altura',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->altura);
				   }
			],
			['label'=>'Frecuencia Cardiaca',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->frecuenciaCardiaca);
				   }
			],
			['label'=>'Intervencion Quirurgica',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->intervencionQuirurgica === 1)? 'si':'no';
				   }
			],
			['label'=>'Suplementos',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->suplementos === 1)? 'si':'no';
				   }
			],
			['label'=>'Observaciones',
			   'attribute'=>'obraSocial',
				   'value'=> function($model){
					   return($model->fichaMedica->observaciones);
				   }
			],

['class' => 'yii\grid\ActionColumn'],
			
];
?>
<h1>Fichas Medicas: </h1>
<?php

$dataProvider= new ActiveDataProvider(['query'=> Persona::find()->where(null) ]);
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
    
	'columns' => $gridColumns
     ]);
?>
 </p>

</div>
