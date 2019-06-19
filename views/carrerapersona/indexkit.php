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
use app\models\Grupo;
use app\models\GrupoSearch;
use app\models\Persona;
use app\models\Estadopagopersona;
use app\models\Estadopago;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard; 
use kartik\tabs\TabsX;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entrega De Kits ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talleRemera">
<h1> <br> </h1>

  
	 <?php
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Corredor',
                'attribute' => 'apellidoPersona',
				'value' => function($model) {
                    return ($model->apellidoPersona.' '.$model->nombrePersona );
                },
            ],
            [   'label' => 'Documento',
                'attribute' => 'dniUsuario',
                'value' => function($model) {
                    return ($model->usuario->dniUsuario);
                },
				
            ],
            ['label' => 'Talle Remera',
                'attribute' => 'talleRemera',
                'value' => function($model) {
                    return ($model->talleRemera->talleRemera);
                },
				'filter' => ArrayHelper::map(Talleremera::find()->asArray()->all(), 'talleRemera', 'talleRemera')
            ],
			 
			['class' => 'yii\grid\ActionColumn',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{update}',
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
