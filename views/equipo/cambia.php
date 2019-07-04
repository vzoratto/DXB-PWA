<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambia capitan';

?>
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd no-label" align="center">
      <img class="center" src="assets/img/logo-color.png" alt="logo color">
        <p><?= Html::encode($this->title) ?></p>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'recupass-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

         <?= $form->field($model, 'dniCapitan')->textInput(['id'=>'cap','placeholder'=>'Ingresa el dni capitan','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'dniUsuario')->textInput(['id'=>'usu','placeholder'=>'Ingresa el dni corredor','autofocus' => true, 'class' => 'form-control']) ?>
            
             
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton('Cambiar', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'recupass-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (Yii::$app->session->hasFlash('registroFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
        Perfecto el corredor con el Dni <?= Html::encode($model->dniUsuario)?> ,ahora es capitan
        </div>
        <?php endif; ?>
    </div>
    
</div>
  







<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="site-error" align="center">
            <img src="registro/atleta11.gif" style="margin:20px;max-width: 150px;">
        </div>
        <div class="alert alert-success" align="center">
        Perfecto el corredor con el Dni <?= Html::encode($model->dniUsuario)?> ,ahora es capitan
        </div>
    <?php endif ?>