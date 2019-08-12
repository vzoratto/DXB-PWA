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
use app\models\Listadeespera;
use app\models\Carrerapersona;
use app\models\Usuario;
use app\models\Equipo;
use app\models\Persona;
use app\models\Estadopagopersona;
use app\models\Estadopago;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado De Participantes ';
?>

<div class="carrerapersona-index reglamento-container">


    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Total de Participantes: <?= Html::encode($dataProvider->getCount()) ?></h2>
	 <?php
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Corredor',
                'class' => ExpandRowColumn::class,
                'attribute' => 'nombre_completo',
				'value' => function($model) {
				   return($model->nombre_completo);
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
                'attribute' => 'categoria',
                'value' => function($model) {
                    return ($model->tipoCarrera->descripcionCarrera);
                },
            'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera'),
            'filterInputOptions' => ['prompt' => 'Elije ...', 'class' => 'form-control', 'id' => null]
            ],
			['label' => 'Equipo',
			'attribute' => 'nombreEquipo',
                'value' => function($model) {
                    return ($model->equipo->nombreEquipo);
                },
            ],
			['label' => 'Capitan',
			'attribute' => 'dniCapitan',
                'value' => function($model) {
                    return ($model->equipo->dniCapitan);
                },
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
           ['label' => 'Espera',
			'attribute' => 'enespera',
                'value' => function($model) {
                    if(isset($model->listadeespera->idPersona)){
                   return ("Si");
                    }else{
                        return ("No");
                    }
                },
               // 'filter' => array("No"=>"No"),
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
</section>
