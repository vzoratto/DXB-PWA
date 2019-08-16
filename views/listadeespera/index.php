<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use app\models\Persona;
use app\models\Usuario;
use app\models\Carrerapersona;
use app\models\Equipo;
use app\models\Tipocarrera; 
use kartik\export\ExportMenu;
use dimmitri\grid\ExpandRowColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ListadeesperaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participantes en lista de espera';
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
				   return($model->persona->nombrecompleto);
                },
                'column_id' => 'column-info',
                'url' => Url::to(['view']),
            ],
            [   'label' => 'Documento',
                'attribute' => 'dniUsuario',
                'hAlign' => 'center',
                'value' => function($model) {
                    return ($model->persona->usuario->dniUsuario);
                },
				
            ],
            ['label' => 'Categoria',
                'attribute' => 'categoria',
                'hAlign' => 'center',
                'value' => function($model) {
                    return ($model->tipoCarrera->descripcionCarrera);
                },
			'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera')
            ],
			['label' => 'Equipo',
            'attribute' => 'nombreEquipo',
            'hAlign' => 'center',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije nombre...'
               ],
                'value' => function($model) {
                  return ($model->equipo->nombreEquipo);
                },
            ],
			['label' => 'DNI Capitan',
            'attribute' => 'dniCapitan',
            'hAlign' => 'center',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije DNI...'
               ],
                'value' => function($model) {
                    return ($model->equipo->dniCapitan);
                },
            ],
          ['class' => 'yii\grid\ActionColumn',
          'header'=>'Quitar de esta Lista' ,
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{delete}',
                   'buttons'=>[
		           'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-delete"></span>',$url,[
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
</section>
