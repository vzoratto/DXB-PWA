<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ControlpagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Control pagos';

?>
<div class="controlpago-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

<!-- La siguiente grilla muestra los datos en pantalla -->
<?php  
	
	$gridColumns=[
           // ['class' => 'yii\grid\SerialColumn'],

           // 'idControlpago',
           ['label'=>'Referencia pago',
            'attribute'=>'idPago',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
            ],
            ['label'=>'Equipo',
             'attribute'=>'equipo',
             'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije equipo...'
            ],
             'hAlign'=>'center',
             'value'=>function($model){
                  return ($model->pago->equipo->nombreEquipo);
                 }
            ],
            ['attribute'=>'nombre',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije uno...'
               ],
			  'value'=>function($model){
				  return($model->pago->persona->nombreCompleto);
			     }
			],
			['label' => 'DNI',
             'attribute' => 'dniUsu',
             'hAlign' => 'center',
             'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije DNI...'
               ],
             'value' => function($model) {
                    return ($model->pago->persona->usuario->dniUsuario);
                },
				
            ],
            ['label'=>'Tipo Carrera',
             'attribute'=>'tipocarrera',
             'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
             'value'=>function($model){
                  return ($model->pago->equipo->tipoCarrera->descripcionCarrera);
                 }
            ],
            [ 'attribute' => 'fechaPago',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
                'format' => ['date', 'php:Y-m-d'],

            ],          
            [ 'attribute' => 'fechachequeado',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
              'value'=>function($model){
                  if($model->fechachequeado=='0000-00-00'){
                      return "";
                  }else{
                      return $model->fechachequeado;
                  }
              }
            ],   
            ['attribute'=>'chequeado',
             'hAlign' => 'center',
             'value'=>function($model){
                 return ($model->chequeado==0)?'no':'si';
             },
               'filter'=>array('0'=>'no','1'=>'si'),
            ],
            //'idGestor',
            
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Acciones',
            'template'=> '{update}',
            ],
        
    ]; 	
	
	// Renders a export dropdown menu
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
	'filename'=>'DesafioBardas',
	'target' => ExportMenu::TARGET_SELF,
	
	'exportConfig' => [
        ExportMenu::FORMAT_HTML => false,
        ExportMenu::FORMAT_TEXT => false,
		ExportMenu::FORMAT_EXCEL => false,
        ExportMenu::FORMAT_PDF => [
            'pdfConfig' => [
                'methods' => [
                    'SetTitle' => 'Pagos acreditados',
                    'SetSubject' => 'Detalle de los pagos ',
                    'SetHeader' => ['Pagos||Generado el: ' . date("r")],
                    'SetFooter' => ['|Page {PAGENO}|'],
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
   
   

</div>
