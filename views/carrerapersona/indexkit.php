<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Talleremera;
use app\models\Tipocarrera;
use app\models\Carrerapersona;
use app\models\Carrerapersonasearch;
use app\models\Usuario;
use app\models\Equipo;
use app\models\Persona;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;

$this->title = 'Entrega De Kits ';
?>
<div class="entregadekits">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <h2>Total de Participantes: <?= Html::encode($dataProvider->getCount()) ?></h2>
	 <?php
	 // definimos las columnas para el gridview en la variable $gridColumn,despues solo llamamos esa variable.
		$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
			[   'label' => 'Corredor',
                'attribute' => 'nombre_completo',
				'value' => function($model) {
					return ($model->nombre_completo);
                },
            ],
            [   'label' => 'Documento',
                'attribute' => 'dniUsuario',
                'value' => function($model) {
                    return ($model->persona->usuario->dniUsuario);
                },
				
            ],
			[   'label' => 'Sexo',
                'attribute' => 'sexoPersona',
                'value' => function($model) {
                    return ($model->persona->sexoPersona);
                },
				
				'filter' => ArrayHelper::map(Persona::find()->asArray()->all(), 'sexoPersona', 'sexoPersona')
            ],
            ['label' => 'Talle Remera',
                'attribute' => 'talleRemera',
                'value' => function($model) {
                    return ($model->persona->talleRemera->talleRemera);
                },
				'filter' => ArrayHelper::map(Talleremera::find()->asArray()->all(), 'talleRemera', 'talleRemera')
            ],
			['label' => 'Retira Kit',
                'attribute' => 'retiraKit',
                'value' => function($model) {
                    return ($model->retiraKit=== 1)? 'si':'no';
                },
				'filter' => ArrayHelper::map(Carrerapersona::find()->asArray()->all(), 'retiraKit', 'retiraKit')
            ],
			 
			['class' => 'yii\grid\ActionColumn',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{updatekit}',
                   'buttons'=>[
		           'updatekit'=>function($url,$model){
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


// Editamos la salida de export;ocultamos otros formatos y modificamos la salida en PDF
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

// renderisamos usando kartic gridview

echo \kartik\grid\
     GridView::widget([
    'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => $gridColumns  // las columnas estan definidas en la variable $gridColumn
     ]);
?>
 </p>

</div>
