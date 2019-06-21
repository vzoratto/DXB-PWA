<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\controllers\RespuestaTipoController;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */
/* @var $form yii\widgets\ActiveForm */

$lista=RespuestaTipoController::listarTipos($encTipo);

$listas=ArrayHelper::map($lista, 'idRespTipo', 'respTipoDescripcion');

?>

<div class="pregunta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pregDescripcion')->textInput(['maxlength' => true, 'autofocus'=>true]) ?>
    <?php if(!$actualizar): ?>
    <?= $form->field($model, 'idRespTipo')->widget(Select2::className(), [
            'data'=>$listas,
            'id'=>'idRespTipo',
            'options'=> [
                'placeholder'=> 'Seleccione un tipo...',
                'id'=>'idRespTipo',
            
            ],
        ])->label('Tipo de respuesta: ');
    ?>
    <?php endif ?>
    <?= $form->field($model, 'idEncuesta')->hiddenInput(['value'=>$model->idEncuesta])->label(false) ?>   

    <div class="form-group">
        <?= Html::submitButton('Guardar cambios', ['class' => 'btn btn-default']) ?>
        <?php if(!$actualizar): ?>
            <?= Html::a('Terminar Encuesta', url::toRoute('encuesta/index'),['class'=>'btn btn-default'])?>
        <?php endif ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
