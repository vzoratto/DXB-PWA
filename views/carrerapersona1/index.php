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
use app\models\Equipo;
use app\models\Persona;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Gestor ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kit-index">

    <h1>Total de Inscriptos: <?= Html::encode($dataProvider->getCount()) ?></h1>
	 
	  
	 <?php
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Apellido',
                'class' => ExpandRowColumn::class,
                'attribute' => 'apellidoPersona',
				'value' => function($model) {
                    return ($model->persona->apellidoPersona);
                },
                'column_id' => 'column-info',
                'url' => Url::to(['view']),
            ],
            [   'label' => 'Nombre',
                'attribute' => 'nombrePersona',
                'value' => function($model) {
                    return ($model->persona->nombrePersona);
                }
            ],
            [   'label' => 'Documento',
                'attribute' => 'dniUsuario',
                'value' => function($model) {
                    return ($model->persona->usuario->dniUsuario);
                },
				
            ],
            ['label' => 'Talle Remera',
                'attribute' => 'talleRemera',
                'value' => function($model) {
                    return ($model->persona->talleRemera->talleRemera);
                },
				'filter' => ArrayHelper::map(Talleremera::find()->asArray()->all(), 'talleRemera', 'talleRemera')
            ],
            ['label' => 'Categoria',
                'attribute' => 'categoria',
                'value' => function($model) {
                    return ($model->tipoCarrera->descripcionCarrera);
                },
		    	'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'categoria', 'descripcionCarrera')
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
		    ['label' => 'Retiro Kit',
			'attribute' => 'retiraKit',
                'value' => function($model) {
					if($model->retiraKit )
                    return ( ($model->retiraKit === 1)? 'si':'no' );
                },
                'filter' => ArrayHelper::map(Carrerapersona::find()-> asArray()->all(), 'retiraKit', 'retiraKit'), 
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
 </div>
