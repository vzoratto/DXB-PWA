<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Recuperar Contraseña';
$this->params['breadcrumbs'][] = $this->title;
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

         <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingresa tu dni','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'email',['inputOptions' => ['class' => 'form-control']])
            ->textinput(['placeholder'=>'Ingresa tu email'])?>
            
             
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton('Recuperar', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'recupass-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
  
