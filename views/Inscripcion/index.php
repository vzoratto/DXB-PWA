<?php

use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard;

/* @var $this yii\web\View */

$this->title = 'Formulario de inscripcion';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inscripciones-index">
    <!-- comienzo del formulario, se define el metodo de envio de datos y se llama a la accion "store" o guardar-->
    <?php $form = ActiveForm::begin([
        'method'=>'post',
        "action"=>"index.php?r=inscripcion%2Fstore",
        "enableClientValidation"=>true,
    ]); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- utilizacion de un widget de jui llamado Tabs, se define cada una de las tabs 
    y dentro de ellas se renderiza su correspondiente vista a las cuales se le envian los 
    modelos correspondientes --> 
    <?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Datos Personales',
            'content' =>$this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form,'talleRemera'=>$talleRemera,'listadoTalles'=>$listadoTalles]),
        ],
        [
            'label' => 'Datos de contacto',
            'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form, 'datos'=>$datos]),

        ],
        [
            'label' => 'Datos medicos',
            'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
        ],
        [
            'label' => 'Contacto de emergencia',
            'content' => $this->render('contactoemergencia',['datosEmergencia'=>$datosEmergencia,'form'=>$form]),
        ],
        [
            'label' => 'Encuesta',
            'content' => $this->render('encuesta',['form'=>$form]),
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div', 'class' => 'tabs-container'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);

     ActiveForm::end(); ?>

</div>

<?php
echo FormWizard::widget([
    'theme' => FormWizard::THEME_CIRCLES,
    'steps' => [
        [
            'model' => [$persona, $usuario],
            'title' => 'Datos personales',
            'description' => 'Paso 1',
            'formInfoText' => 'Fill all fields',
            'fieldOrder'=> ['dniCapitan','dniUsuario','nacionalidadPersona','nombrePersona','apellidoPersona'],
            'fieldConfig' => [
                'dniCapitan' => [
                    'labelOptions' => [
                        'label' => 'D.N.I. Capitan: ',
                    ],
                    'containerOptions' => [
                        'class' => 'col-md-4 col-lg-4 col-sm-4 col-xs-6'
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ],
                'dniUsuario' => [
                    'labelOptions' => [
                        'label' => 'D.N.I.: ',
                    ],
                    'containerOptions' => [
                        'class' => 'col-md-4 col-lg-4 col-sm-4 col-xs-6'
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ],
                'nacionalidadPersona' => [
                    'labelOptions' => [
                        'label' => 'Nacionalidad: ',
                    ],
                    'containerOptions' => [
                        'class' => 'col-md-4 col-lg-4 col-sm-4 col-xs-6'
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ],
                'nombrePersona' => [
                    'labelOptions' => [
                        'label' => 'Nombre: ',
                    ],
                    'containerOptions' => [
                        'class' => 'col-md-6 col-lg-6 col-sm-6 col-xs-12'
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ],
                'apellidoPersona' => [
                    'labelOptions' => [
                        'label' => 'Apellido: ',
                    ],
                    'containerOptions' => [
                        'class' => 'col-md-6 col-lg-6 col-sm-6 col-xs-12'
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ],
                'fechaNacPersona_at' => [
                    'labelOptions' => [
                        'label' => 'Fecha Nacimiento: ',
                    ],
                    'widget' => DatePicker::class, //widget class name
                    'options' => [ // you will pass the widget options here
                        'options' => [
                            'placeholder' => 'Select a Date',
                            'id' => 'my-datepicker',
                            'class' => 'form-control'
                        ],
                        'dateFormat'=>'short'
                    ],
                ],
            ]
        ],
        [
            'model' => $personaDireccion,
            'title' => 'Datos de contacto',
            'description' => 'Paso 2',
            'formInfoText' => 'Fill all fields'
        ],
        [
            'model' => $fichaMedica,
            'title' => 'Datos medicos',
            'description' => 'Paso 3',
            'formInfoText' => 'Fill all fields'
        ],
        [
            'model' => $datosEmergencia,
            'title' => 'Contacto de emergencia',
            'description' => 'Paso 4',
            'formInfoText' => 'Fill all fields'
        ],
        /*[
            'model' => $encuesta,
            'title' => 'Encuesta',
            'description' => 'Paso 5',
            'formInfoText' => 'Fill all fields'
        ],*/
    ]
]);?>