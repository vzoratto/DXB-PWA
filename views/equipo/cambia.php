<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambia capitán';

?>
<div class='reglamento-container'>
       <h3><?= 'Cambiar capitán del equipo en caso de no asistir al evento'?></h3>
        <h2><?= Html::encode($this->title) ?></h2>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'cambiaCapitan-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>
         <div class='row no label'>
         <?= $form->field($model, 'dniCapitan')->textInput(['id'=>'cap','placeholder'=>'Ingresa el dni capitán','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'dniUsuario')->textInput(['id'=>'usu','placeholder'=>'Ingresa el dni corredor','autofocus' => true, 'class' => 'form-control']) ?>
         </div>  
             
        <div class="form-group">
            
               <?= Html::submitButton('Verificar capitán', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'cambia-button']) ?>
            
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (Yii::$app->session->hasFlash('per1FormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
        El usuario DNI <?= Html::encode($model->dniusuario)?> no esta inscripto.
        </div>
        <?php elseif (Yii::$app->session->hasFlash('usu1FormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
         El Dni <?= Html::encode($model->dniUsuario)?> usuario no existe.
        </div>
        <?php elseif (Yii::$app->session->hasFlash('estadoFormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
         El equipo con DNI <?= Html::encode($model->dniCapitan)?> capitán no pago la inscripcion.
        </div>
        <?php elseif (Yii::$app->session->hasFlash('capFormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
        El DNI <?= Html::encode($model->dniCapitan)?> capitán no existe.
        </div>
        <?php endif; ?>
    
   <?Php if(isset($mensaje)){
        echo '<h3>'.Html::encode($mensaje).'</h3>';
    }?>
</div>
  







