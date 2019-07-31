<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Pago;
use app\models\Estadopago;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadopagoequipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estado del pago por equipo';

?>
<div class="estadopagoequipo-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>
 <!-- La siguiente grilla muestra los datos en pantalla -->
 <?php  
	
	$gridColumns=[
            ['class' => 'yii\grid\SerialColumn'],
           ['label'=>'Referencia equipo',
             'attribute'=>'idEquipo',
             'hAlign' => 'center',
             "filterInputOptions" => ['class'=>'form-control',
             "disabled" => true
             ],
           ],
           ['label'=>'Nombre equipo',
            'attribute'=>'nombreEquipo',
            'hAlign' => 'center',
            'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Elije equipo...'
                ],
            'value'=>function($model){
               return ($model->equipo->nombreEquipo);
             }
           ],  
           ['label' => 'DNI capitán',
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
          ['label' => 'Email capitán',
           'attribute' => 'mailusuario',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
           'value' => function($model) {
               return ($model->equipo->usuario->mailUsuario);
              }
          ],
          ['label'=>'$ Pagado',
              'attribute'=>'idEquipo',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
           'value'=>function($model){
            return   Pago::sumaTotalequipo($model);
           }
          ],
           ['label'=>'Estado pago',   
           'attribute' => 'idEstadoPago',
           'hAlign' => 'center',
           'value' => function($model) {
               return ($model->estadoPago->descripcionEstadoPago);
              },
            'filter' => Html::activeDropDownList($searchModel, 'idEstadoPago', ArrayHelper::map(Estadopago::find()->asArray()->all(), 'idEstadoPago', 'descripcionEstadoPago'),
             ['class'=>'form-control','prompt' => 'Elije.....................']),
          ],
           ['label'=>'Costo inscripcion',
            'attribute'=>'importe',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
            'value'=>function($model){
                $print='';
                foreach($model->equipo->tipoCarrera->importeinscripcion as $importe){ 
                   $print.=$importe->importe;
                }
            return $print;
            },   
           ],
           ['class' => 'yii\grid\ActionColumn',
           'header' => 'Acciones',
                 'contentOptions'=>
				 ['style'=>'width: 10%;'],
                   'template'=>'{view}  {mail}',
                   'buttons' => [
                    'mail' => function ($url, $model, $key) {//id1=idEstadoPago, id=idEquipo
                        return Html::a ( '<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> ', ['equipo/enviomail', 'id1' => $model->idEstadoPago, 'id' => $model->idEquipo],['title'=>'Envio mail'] );
                    },
                ],
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
                    'SetTitle' => 'Estado de los pagos realizados',
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

