<?php


use app\controllers\PreguntaController;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\RespuestaOpcion*/
/* @var $idPregunta app\models\Pregunta*/

$this->title = 'Cargar Las opciones de la lista';
$this->params['breadcrumbs'][] = ['label' => 'Opciones de respuesta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(!isset($idPregunta)){
    $idPregunta=$model->idPregunta;
}
$preg=PreguntaController::entregaPregunta($idPregunta);
$idEncuesta=$preg->idEncuesta;
?>

<h4>Ingresar las opciones de respuesta para la pregunta:</h4>
<h3><?= $preg->pregDescripcion; ?></h3>
<hr>
<p>Entre estas opciones se podra elegir <strong>solo una</strong></p>
<?php $form = ActiveForm::begin([
        'method'=>'post',
        'action'=>Url::toRoute('respuesta-opcion/crea-drop'),
])?>
	<div class='form-group'>
		<?= $form->field($model, 'opRespvalor')->textInput()->label('Opcion: ')?>
		<?= $form->field($model, 'idPregunta')->hiddenInput(['value'=>$idPregunta])->label(false)?>
	</div>
	<div class='form-group'>
		<?= Html::submitButton('Guardar Opcion', ['class'=>'btn btn-primary'])?>
		<?= Html::a('Nueva Pregunta', url::toRoute(['pregunta/create','id'=>$idEncuesta]),['class'=>'btn btn-primary'])?>
	</div>
<?php ActiveForm::end()?>
