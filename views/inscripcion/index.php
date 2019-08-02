<?php

use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard;

/* @var $this yii\web\View */

?>
<div class="db-registro cover-background contenedor-full pt-eight" style="background-image:url('assets/img/fondo-color.jpg');">
    <!-- comienzo del formulario, se define el metodo de envio de datos y se llama a la accion "store" o guardar-->
    <div class="db-card">

      <?php $form = ActiveForm::begin([
          'method'=>'post',
          "action"=>"index.php?r=inscripcion%2Fstore",
      		"enableClientValidation"=>true,
      ]); ?>
	  <input type="hidden" value="0" id="editar">

<?php

$wizard_config = [
	'id' => 'stepwizard',
	'steps' => [
		1 => [
			'title' => 'Datos Personales',
			'icon' => 'glyphicon glyphicon-user',
			'content' => $this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form,'talleRemera'=>$talleRemera,'listadoTalles'=>$listadoTalles,'equipoLista'=>$equipoLista,'equipo'=>$equipo,'tipoCarrera'=>$tipoCarrera,'tipocarreraLista'=>$tipocarreraLista,'cantCorredores'=>$cantCorredores,'swicht'=>$swicht,'user'=>$user]),
			'buttons' => [


                'next' => [
        'title' => 'Siguiente',
        'options' => [
          'class'=> 'btn btn-next',
        ]

			 ],
		],	],

		2 => [
			'title' => 'Datos de contacto',
			'icon' => 'glyphicon glyphicon-envelope',
			'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form, 'datos'=>$datos,'user'=>$user]),
			'buttons' => [
                'next' => [
                    'title' => 'Siguiente',
                    'options' => [
                      'class'=> 'btn btn-next',
                    ]
				],
				'previous' => [
					'title' => 'Atras',
				]
            ],
		],
		3 => [
			'title' => 'Datos medicos',
			'icon' => ' glyphicon glyphicon-plus',
			'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
			'buttons' => [
                'next' => [
                    'title' => 'Siguiente',
                    'options' => [
                      'class'=> 'btn btn-next',
                    ]
        				],
        				'previous' => [
        					'title' => 'Atras',
        				]
                    ],
        		],
        		3 => [
        			'title' => 'Datos medicos',
        			'icon' => ' glyphicon glyphicon-plus',
        			'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
        			'buttons' => [
                        'next' => [
                            'title' => 'Siguiente',
                            'options' => [
                              'class'=> 'btn btn-next',
                            ]
        				],
        				'previous' => [
        					'title' => 'Atras',
        				]
                    ],
        		],
        		4 => [
        			'title' => 'Contacto de emergencia',
        			'icon' =>'glyphicon glyphicon-heart-empty',

			'content' => $this->render('contactoemergencia',['datosEmergencia'=>$datosEmergencia,'form'=>$form]),
			'buttons' => [
                'next' => [
                    'title' => 'Siguiente',
                    'options' => [
                      'class'=> 'btn btn-next',
                    ]
				],
				'previous' => [
					'title' => 'Atras',
				]
            ],
		],
		5 => [
			'title' => 'Encuesta',
			'icon' => 'glyphicon glyphicon-list-alt',
			'content' => $this->render('@app/views/encuesta/encuesta.php',['respuesta'=>$respuesta,'form'=>$form]),
            'buttons' => [
                'next' => [
                    'title' => 'Siguiente',
                    'options' => [
                      'class'=> 'btn btn-next',
                    ]
                ],
                'previous' => [
                    'title' => 'Atras',
                ]
            ],
		],
        6 => [
            'title' => 'Reglamento',
            'icon' => 'glyphicon glyphicon-file',
			'content' => $this->render('reglamento',['carrerapersona'=>$carrerapersona,'form'=>$form]),
            'buttons' => [
                'save' => [
                    'html' => Html::submitButton(
                        Yii::t('app', 'Terminar inscripción'),
                        [
                            'class' => 'btn btn-success',
							'value' => 'Terminar inscripción',
							'disabled' => false
                        ]
                    ),
                ],
                'previous' => [
                    'title' => 'Atras',
                ]
            ],
        ],
        	],
        	'start_step' => 1, // Optional, start with a specific step
        ];
        ?>
        <div class="container sm-p-0">

          <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

        </div>

    </div>

</div>
<?php ActiveForm::end(); ?>
