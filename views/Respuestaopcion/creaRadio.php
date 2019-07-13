<?php
/* ---------------------------------------------------------------------------------------------
-- Vista que nos permite la generación y carga de las opciones de Radio
-- ----------------------------------------------------------------------------------------------*/
use app\controllers\PreguntaController;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\EncuestaSearch;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcion*/
/* @var $opciones app\models\RespuestaOpcion*/
/* @var $idPregunta app\models\Pregunta*/

$this->title = 'Cargar Las opciones del Radio';

if(!isset($idPregunta)){
    $idPregunta=$model->idPregunta;
}
$preg=PreguntaController::entregaPregunta($idPregunta);
$idEncuesta=$preg->idEncuesta;
$encuesta=EncuestaSearch::findOne($idEncuesta);
?>
<div class="container">

	<h3>Ingresar las opciones de respuesta para:</h3>
	<h3><?= $preg->pregDescripcion; ?></h3>
	<hr>
	<h4>Entre estas opciones se podra elegir <strong>solo una</strong></h4>

	<!-- Muestra las opciones cargadas con anterioridad -->
	<?php if($opciones!=null): ?>
		<?php $i=1; ?>
		<div class="alert alert-success">

			<p>Opciones ya cargadas:</p>
			<?php foreach($opciones as $unaOpcion): ?>
				<p><strong><?php echo $i." - ".$unaOpcion['opRespvalor'] ?></strong></p>
				<?php $i++ ?>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	
	<?php $form = ActiveForm::begin([
			'method'=>'post',
			'action'=>Url::toRoute('respuestaopcion/crea-radio'),
	])?>
		<div class='form-group'>
			<?= $form->field($model, 'opRespvalor')->textInput(['autofocus'=>true])->label('Opcion: ')?>
			<?= $form->field($model, 'idPregunta')->hiddenInput(['value'=>$idPregunta])->label(false)?>
		</div>
		<div class='form-group'>
			<?= Html::submitButton('Guardar Opcion', ['class'=>'btn btn-default'])?>
			<?php if($encuesta->encTipo=='trivia'): ?>
				<?= Html::a('Define respuestas correctas', url::toRoute(['respuesta-trivia/create','idPregunta'=>$idPregunta]),['class'=>'btn btn-default'])?>
			<?php endif ?>
			<?= Html::a('Nueva Pregunta', url::toRoute(['pregunta/create','id'=>$idEncuesta]),['class'=>'btn btn-default'])?>
			<?= Html::a('Terminar Encuesta', url::toRoute('encuesta/index'),['class'=>'btn btn-default'])?>
		</div>
	<?php ActiveForm::end()?>
</div>
