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
use app\models\Persona;
use app\models\Estadopagopersona;
use app\models\Estadopago;

use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard; 

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos';

?>

<section id="cambiapass" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
  <div class="equipo-index">
    <div class=' col-md-offset-1 col-md-9 '>
      <div class='text-center'>
          <img src="../web/assets/img/logo-color.png" alt="logo-color" class="mb-20" style="max-width:150px;"> 
     
          <h3><strong>Listado de equipos participantes</strong></h3>
          <p><strong>Verde: grupo de 2 corredores.  Marrón: grupo de 4 corredores.</strong></p>
      </div>
         

     
	
		 <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summary'=>'',
            'rowOptions' => function ($model) {

                if ($model->cantidadPersonas == 4){ 
                    return ['style' => 'background-color: #ECE4C5'];//marron
                }else{
                    return ['style' => 'background-color: #C5ECCF' ];//verde
               }
                
            },
             
            'columns' => [ 

               // ['class' => 'yii\grid\SerialColumn',
               // 'contentOptions' => ['style' => 'width:80px; white-space: normal;'],
            //],
                ['label' => 'Tipo de Carrera',
                'attribute' => 'idTipoCarrera',
                'contentOptions' => ['style' => 'width:150px; white-space: normal;'],
                "filterInputOptions" => ['class'=>'form-control',
                "disabled" => true
                ],
                'value' => function($model) {
                    return ($model->tipoCarrera->descripcionCarrera);
                },
           
            
            ],	
           
			[   'label' => 'Nombre Equipo',
                'attribute' => 'nombreEquipo',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;text-align:center;'],
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Elije equipo...'
                    ],
				'value' => function($model) {
                    return ($model->nombreEquipo);
                },
                
            ],
			
		     ['label'=>' Integrantes',
              'attribute'=>'idEquipo',
              'contentOptions' => ['style' => 'width:500px; white-space: normal;'],
              "filterInputOptions" => ['class'=>'form-control',
              "disabled" => true
              ],
              'value'=>function($model){
                  $print='';
                  $per=1;
                  foreach($model->persona as $persona){
                      $print.=$per."-".$persona->nombrePersona." ".$persona->apellidoPersona." ||  ";
                      $per+=1;
                  }
                  return $print;
              },
              
            ],
			[   'label' => 'Resultados',
                'attribute' => 'idEquipo',
                'contentOptions' => ['style' => 'width:100px; white-space: normal;'],
				'value' => function($model) {
                    return '';
                },
                
            ],
			
        ],
     ]);
        ?>
    </div>
  </div>
</section>

