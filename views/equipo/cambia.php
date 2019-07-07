<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambia capitan';

?>
       <h3><?= 'Cambiar capitan de equipo en caso de no asistir al evento'?></h3>
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
         <?= $form->field($model, 'dniCapitan')->textInput(['id'=>'cap','placeholder'=>'Ingresa el dni capitan','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'dniUsuario')->textInput(['id'=>'usu','placeholder'=>'Ingresa el dni corredor','autofocus' => true, 'class' => 'form-control']) ?>
         </div>  
             
        <div class="form-group">
            
               <?= Html::submitButton('Cambiar capitan', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'cambia-button']) ?>
            
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (Yii::$app->session->hasFlash('cambiaFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
        Perfecto el corredor con el Dni <?= Html::encode($model->dniUsuario)?> ,ahora es capitan
        </div>
        <?php elseif (Yii::$app->session->hasFlash('nocambiaFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
         El capitan con el Dni <?= Html::encode($model->dniUsuario)?> ,no existe en el equipo.
        </div>
        <?php endif; ?>
    </div>
    
</div>
  







