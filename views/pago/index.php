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
            "filterInputOptions" => ['class'=>'form-control',
             "disabled" => true
             ],
            'value'=>function($model){
                return $model->idPago;
            }
           ],
           ['label'=>'Nombre equipo',
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
           ['attribute'=>'nombre',
           'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Elije nombre...'
            ],
           'value'=>function($model){
               return ($model->persona->nombreCompleto);
               }
           ],
           [   'label' => 'DNI',
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
          ['attribute'=>'entidadPago',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
             "disabled" => true
             ],
           ],
          ['attribute'=>'importePagado',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
             "disabled" => true
             ],
           ],
           ['attribute'=>'chequeado',
            'hAlign' => 'center',
            'value'=>function($model){
                $print='';
                foreach($model->controlpagos as $check){ 
                   $print.=($check->chequeado===0)?"no":"si";
                }
            return $print;
            },
              'filter'=>(["0"=>"no","1"=>"si"]),
              'filterInputOptions' => ['prompt' => 'Elije...', 'class' => 'form-control', 'id' => null]
           ],
           ['label'=>'Imagen ticket',
            'attribute'=>'imagenComrobante',
            'format'=>'html',
            'value'=>function($model){
                return yii\bootstrap\Html::img($model->imagenComprobante,['width'=>'50']); 
            },
           ],
           ['class' => 'yii\grid\ActionColumn',
           'header' => 'Acciones',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{view}',
           
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
                    'SetTitle' => 'Pagos recibidos',
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
