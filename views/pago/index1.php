<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Controlpago;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pagos recibidos';

?>
<div class="pago-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>
    
   
 <!-- La siguiente grilla muestra los datos en pantalla -->
 <?php  
	
	$gridColumns=[
           // ['class' => 'yii\grid\SerialColumn'],
            ['label'=>'Referencia pago',
            'attribute'=>'idPago',
            'hAlign' => 'center',
            'value'=>function($model){
                return $model->idPago;
            }
           ],
           ['label'=>'Equipo',
            'attribute'=>'idEquipo',
            'hAlign' => 'center',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije equipo...'
                ],
            'value'=>function($model){
               return ($model->equipo->nombreEquipo);
             }
           ],  
           [   'label' => 'DNI capitán',
           'attribute' => 'dniUsu',
           'hAlign' => 'center',
           'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Elije DNI...'
            ],
           'value' => function($model) {
               return ($model->persona->usuario->dniUsuario);
              },
          ],
          
          ['attribute'=>'importePagado',
           'hAlign' => 'center',
           ],
          /* [   
           'attribute' => 'estadoPago',
           'hAlign' => 'center',
           'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Elije ...'
            ],
           'value' => function($model) {
               return ($model->estadoPago->descripcionEstadoPago);
              },
          ],*/
           
           ['class' => 'yii\grid\ActionColumn',
           'header' => 'Acciones',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{view}{update}',
           
		    	],
           
           //'idImporte',
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
