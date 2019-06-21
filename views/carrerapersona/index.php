<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
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
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;

use buttflattery\formwizard\FormWizard; 
use kartik\tabs\TabsX;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Gestor ';
?>
<div class="persona-index">
<h1> <br> </h1>


	  
	 <?php
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Corredor',
                'class' => ExpandRowColumn::class,
                'attribute' => 'apellidoPersona',
				'value' => function($model) {
                    return ($model->persona->apellidoPersona.' '.$model->persona->nombrePersona );
                },
                'column_id' => 'column-info',
                'url' => Url::to(['view']),
            ],
            [   'label' => 'Documento',
                'attribute' => 'dniUsuario',
                'value' => function($model) {
                    return ($model->persona->usuario->dniUsuario);
                },
				
            ],

            ['label' => 'Categoria',
                'attribute' => 'idTipoCarrera',
                'value' => function($model) {
                    return ($model->tipoCarrera->descripcionCarrera);
                },
			'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera')
            ],
			['label' => 'Equipo',
			'attribute' => 'nombreEquipo',
                'value' => function($model) {
					//if($model->nombreEquipo ){
                    return ($model->equipo->nombreEquipo);
					
                },
             //   'filter' => ArrayHelper::map(Persona::find()->asArray()->all(), 'idPersona', 'donador'),
            ],
			['label' => 'Capitan',
			'attribute' => 'dniCapitan',
                'value' => function($model) {
					//if($model->nombreEquipo ){
                    return ($model->equipo->dniCapitan);
					
                },
             //   'filter' => ArrayHelper::map(Persona::find()->asArray()->all(), 'idPersona', 'donador'),
            ],
          ['class' => 'yii\grid\ActionColumn',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{update}{delete}',
                   'buttons'=>[
		           'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,[
                       'class'=>'btn btn-block btn-flat sejajar',
                       'style'=>'width : 50%',
                    ]);
                }
		    	],		
           ],
			
	
	
	
];
?>
<?php
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
	'columns' => $gridColumns
     ]);
?>
 </p>

</div>
