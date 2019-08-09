<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambia corredor';

?>
<div class='reglamento-container'>
       <h3><?= 'Cambiar corredor del equipo en caso de no asistir al evento'?></h3>
        <h2><?= Html::encode($this->title) ?></h2>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'cambiaCorredor-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>
         <div class='row no label'>
         <?= $form->field($model, 'dniCorredor')->textInput(['id'=>'cap','placeholder'=>'Ingresa el dni corredor','autofocus' => true, 'class' => 'form-control']) ?>
         </div>  
             
        <div class="form-group">
            
               <?= Html::submitButton('Verificar corredor', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'cambiacorredor-button']) ?>
            
        </div>

        <?php ActiveForm::end(); ?>
        
        <?php if (Yii::$app->session->hasFlash('estadoFormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
         El equipo con DNI <?= Html::encode($model->dniCorredor)?> corredor no pago la inscripcion.
        </div>
        <?php elseif (Yii::$app->session->hasFlash('corredorFormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
        El DNI <?= Html::encode($model->dniCorredor)?> corredor no pertenece a un equipo.
        </div>
        <?php elseif (Yii::$app->session->hasFlash('usuarioFormSubmitted')): ?>
        <div class="alert alert-danger" align="center">
        El DNI <?= Html::encode($model->dniCorredor)?> usuario no existe.
        </div>
        <?php endif; ?>
   
   
</div>
  







