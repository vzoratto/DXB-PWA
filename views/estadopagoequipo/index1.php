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
$this->title = 'Estado del pago: no abonado';
?>
<div class="estadopagoequipo-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>
 <!-- La siguiente grilla muestra los datos en pantalla -->
 <?php 
  foreach($fechas as $fecha){
    if($fecha->idTipoCarrera==1){
      $date1 = new DateTime($fecha->fechaLimiteUno);
      $date2 = new DateTime("now");
      $diff = $date1->diff($date2);
       $diff1=$diff->days;
     }elseif($fecha->idTipoCarrera==2){
          $date1 = new DateTime($fecha->fechaLimiteUno);
          $date2 = new DateTime("now");
          $diff = $date1->diff($date2);
          $diff2=$diff->days;
      }
    }
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
           ],  
           ['label' => 'DNI capitán',
           'attribute' => 'dniCapitan',
           'hAlign' => 'center',
           'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Elije DNI...'
            ],
          ],
          ['label' => 'Email capitán',
           'attribute' => 'mailusuario',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
           'value' => function($model) {
               return ($model->usuario->mailUsuario);
              }
          ],
          ['label'=>'$ Pagado',
            'attribute'=>'idEquipo',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
           'value'=>function($model){
            return $suma=Pago::sumaEquipo($model->idEquipo)==0?"0":"";
               
           }
          ],
          ['label'=>'Estado pago',   
           'attribute' => 'estadopago',
           'hAlign' => 'center',
           "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
           'value' =>function($model){
            return   $model='impago'; 
           } 
          ],
          /*['label'=>'Deshabilitado',
           'attribute'=>'deshabilitado',
           'hAlign' => 'center',
           'value'=>function($model){
               return ($model->deshabilitado==0?"no":"si");
                }
           ],*/
           ['label'=>'Costo inscripcion',
            'attribute'=>'importe',
            'hAlign' => 'center',
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
            'value'=>function($model){
                $print='';
                foreach($model->tipoCarrera->importeinscripcion as $importe){ 
                   $print.=$importe->importe;
                }
            return $print;
            },   
           ],
           ['label'=>'Más detalles',
            'attribute'=>'',
           'format'=>'raw',
           'hAlign' => 'center',
           'contentOptions'=>['style'=>'width:100px;'],
           'value'=>function($model){
               return Html::a('<span class = " glyphicon glyphicon-eye-open"></span>', 
                          [ 'estadopagoequipo/view1',
                           'idEquipo'=>$model->idEquipo]);
               }
           ],
           ['label'=>'Enviar email',
            'attribute'=>'',
           'format'=>'raw',
           'hAlign' => 'center',
           'contentOptions'=>['style'=>'width:100px;'],
           'value'=>function($model){
               return Html::a('<span class = " glyphicon glyphicon-envelope"></span>', 
                          [ 'estadopagoequipo/enviamail',
                           'idEquipo'=>$model->idEquipo]);
               }
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
    'rowOptions'=>$diff1<=10 && $diff2<=10?['class'=>'danger']:['class'=>'success'],  
	'columns' => $gridColumns,
	'options' => [
		'class' => 'table-responsive',
	],
     ]);
?>



</div>