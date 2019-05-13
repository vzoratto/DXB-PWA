<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">


<div class="datosPersonales" >
    <div id="cuilUsuario">
        <?= $form->field($usuario, 'cuilUsuario')->textInput() ?>
    </div>

    <div id="nombrePersona">
        <?= $form->field($persona, 'nombrePersona')->textInput(['maxlength' => true]) ?>
    </div>

    <div id="apellidoPersona">
        <?= $form->field($persona, 'apellidoPersona')->textInput(['maxlength' => true]) ?>
    </div>

    <div id="fechaNacPersona">
        <label>Fecha de Nacimiento</label>
        <?= DatePicker::widget([
            'name' => 'dp_2',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'options' => ['placeholder' => 'Seleccione su fecha de nacimiento'],
            'language' => 'es',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy',
            ]
        ])?>
    </div>

    <div id="idSexoPersona">
    <!-- campo tipo select tambien llamado dropDownList, se carga con los datos de la base especificamente de la tabla Busquedas-->
        <?= $form->field($persona, 'idSexoPersona')->dropDownList(
                \yii\helpers\ArrayHelper::map(\app\models\Sexo::find()->all(),'idSexo','descripcionSexo'),
                ['prompt'=>'Seleccione su sexo...']
        )->label('Sexo'); ?>
    </div>

    <div id="nacionalidadPersona">
        <?= $form->field($persona, 'nacionalidadPersona')->textInput(['maxlength' => true]) ?>
    </div>

</div>


    <div class="form-group">
        <?= Html::Button('Siguiente', ['class' => 'btn btn-info']) ?>
    </div>



</div>