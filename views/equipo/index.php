<?php
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
use app\models\Persona;
use app\models\Estadopagopersona;
use app\models\Estadopago;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard; 

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index reglamento-container">


    <h1>Total de Equipos: <?= Html::encode($dataProvider->getCount()) ?></h1>

    <p>
      <?php //echo Html::a('Inscribir Equipo', ['equipo/create'], ['class' => 'btn btn-primary']) ?>
	  <?php // echo Html::a('Ver Corredores', ['carreraPersona/index'], ['class' => 'btn btn-primary']) ?>
      <?php // echo  Html::a('otros datos', ['persona'], ['class' => 'btn btn-primary' ,'title'=>'lista']) ?>
	 
	  
	 <?php
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Nombre Equipo',
                //'class' => ExpandRowColumn::class,
                'attribute' => 'nombreEquipo',
				'value' => function($model) {
                    return ($model->nombreEquipo);
                },
                //'column_id' => 'column-info',
                //'url' => Url::to(['view']),
            ],
			['class' => 'yii\grid\ActionColumn',
			    'header'=>'Cambiar Nombre',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{update}',
                   'buttons'=>[
		           'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,[
                       'class'=>'btn btn-block  btn-flat sejajar',
                       

                    ]);
                }
			],		
          ],
		  'dniCapitan',
			['label'=>'Cantidad de Corredores',
			   'attribute'=>'cantidadPersonas',
			   'value'=> function($model){
					   return($model->cantidadPersonas);
				   }
			],
			['label' => 'Tipo de Carrera',
                'attribute' => 'idTipoCarrera',
                'value' => function($model) {
                    return ($model->tipoCarrera->descripcionCarrera);
                },
			'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera')
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
	'columns' => $gridColumns
     ]);
?>
 </p>

</div>
