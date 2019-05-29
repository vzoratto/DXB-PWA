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

<?php
$wizard_config = [
	'id' => 'stepwizard',
	'steps' => [
		1 => [
			'title' => 'Datos Personales',
			'icon' => 'glyphicon glyphicon-user',
			'content' => $this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form,'talleRemera'=>$talleRemera,'listadoTalles'=>$listadoTalles]),
		],
		2 => [
			'title' => 'Datos de contacto',
			'icon' => 'glyphicon glyphicon-envelope',
			'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form, 'datos'=>$datos]),
		],
		3 => [
			'title' => 'Datos medicos',
			'icon' => ' glyphicon glyphicon-plus',
			'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
		],
		4 => [
			'title' => 'Contacto de emergencia',
			'icon' => 'glyphicon glyphicon-heart',
			'content' => $this->render('contactoemergencia',['datosEmergencia'=>$datosEmergencia,'form'=>$form]),
		],
		5 => [
			'title' => 'Encuesta',
			'icon' => 'glyphicon glyphicon-list-alt',
			'content' => $this->render('encuesta',['form'=>$form]),
		],
	],
	'start_step' => 1, // Optional, start with a specific step
];
?>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>

</div>
<?php ActiveForm::end(); ?>
