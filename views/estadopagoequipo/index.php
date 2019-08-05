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
?>
<div class="estadopagoequipo-index reglamento-container">

      <?Php   if($diff1<=10 && $diff2<=10):?>  
          <div  class="alert alert-danger" style='color:red'> 
            <h4><?= Html::encode("Es la fecha límite, hay que enviarle un email a los capitanes de los equipos que no terminaron de abonaron la inscripción") ?></h4>
          </div>   
   <?Php endif ?>
    <h1><?= Html::encode($this->title) ?></h1>
 <!-- La siguiente grilla muestra los datos en pantalla --> 
   <?php     
	  $gridColumns=[
           // ['class' => 'yii\grid\SerialColumn'],
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
            return Pago::sumaEquipo($model->idEquipo);
               
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
          ['label'=>'Debe pagar',
            'attribute'=>'importe',
            'hAlign' => 'center',
            "contentOptions" =>["style"=>"color:red;"],  
            "filterInputOptions" => ['class'=>'form-control',
            "disabled" => true
            ],
            'value'=>function($model){
                $print='';
                foreach($model->equipo->tipoCarrera->importeinscripcion as $importe){ 
                  $suma=Pago::sumaEquipo($model->equipo->idEquipo);
                  $cant=$model->equipo->cantidadPersonas;
                  $cantper=$importe->importe * $cant;
                  $costo=$cantper -$suma;
                   $print.=$costo;//para importe indcripcion por persona
                   //$print.=$importe->importe;//para importe incripcion por equipo
                }
            return $print;
            },   
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
                  $cant=$model->equipo->cantidadPersonas;
                  $costo=$importe->importe * $cant;
                   $print.=$costo;//para importe indcripcion por persona
                   //$print.=$importe->importe;//para importe incripcion por equipo
                }
            return $print;
            },   
           ],
           ['label'=>'Enviar email',
            'attribute'=>'',
           'format'=>'raw',
           'hAlign' => 'center',
           'contentOptions'=>['style'=>'width:100px;'],
           'value'=>function($model){
                  if($model->idEstadoPago==2){
                     return  Html::a('<span class = " glyphicon glyphicon-envelope"></span>', 
                          [ 'estadopagoequipo/view',
                          'idEstadoPago'=>$model->idEstadoPago,
                           'idEquipo'=>$model->idEquipo]);
                  }
               }
           ],
           ['class' => 'yii\grid\ActionColumn',
           'header' => 'Acción',
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