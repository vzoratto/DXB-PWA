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
    <?php /*$form = ActiveForm::begin([
        'method'=>'post',
        "action"=>"index.php?r=inscripcion%2Fstore",
        "enableClientValidation"=>true,
    ]);*/ ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo FormWizard::widget([
    'formOptions' => [
        'id' => 'my_form_multi_model_single_step',
        'options'=>[
            'class'=>'form-inline'
        ],
    ],
    'theme' => FormWizard::THEME_CIRCLES,
    'steps' => [
        [
            'model'=>[$persona,$usuario],
            'title' => 'Datos personales',
            'description' => 'Paso 1',
            'formInfoText' =>'Los campos marcados con * son obligatorios',
            'fieldConfig' => [
                'only' => ['dniCapitan','dniUsuario','nacionalidadPersona', 'nombrePersona','apellidoPersona','fechaNacPersona','sexoPersona','idTalleRemera'], // only these field will be added in the step, rest all will be hidden/ignored.
            ]    
        ],
        [
            'model' =>[$personaDireccion,$persona,$provincia],
            'title' => 'Datos de contacto',
            'description' => 'Paso 2',
            'formInfoText' => 'Fill all fields',
            'fieldConfig' => [
                'only' => ['telefonoPersona','mailPersona','idProvincia', 'idLocalidad','direccionUsuario'], // only these field will be added in the step, rest all will be hidden/ignored.
            ]
        ],
        [
            'model' => [$fichaMedica,$persona],
            'title' => 'Datos medicos',
            'description' => 'Paso 3',
            'formInfoText' => 'Fill all fields',
            'fieldConfig' => [
                'only' => ['obraSocial','peso', 'altura', 'frecuenciaCardiaca','evaluacionMedica','intervencionQuirurgica','tomaMedicamentos','suplementos','idGrupoSanguineo','donador'], // only these field will be added in the step, rest all will be hidden/ignored.
            ]
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
]);
   
     //ActiveForm::end(); ?>

</div>
