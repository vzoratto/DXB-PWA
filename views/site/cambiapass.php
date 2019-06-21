<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CambiapassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambiar Password';
$this->params['breadcrumbs'][] = $this->title;
$usu=Yii::$app->user->identity->dniUsuario;
?>
<div class="site-cambiapass">
    <div class="form-group col-lg-6 col-md-offset-3" align="center">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Recuerda que luego debes iniciar sesion con tu nueva contraseña.</p>
    </div>
    <div class="form-group col-lg-6 col-md-offset-3">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'cambiapass-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

         <?= $form->field($model, 'dni')->textInput(['value'=>$usu,'readonly'=> true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Ingresa tu contraseña','autofocus' => true]) ?>
         
         <?= $form->field($model, 'nuevo_password')->passwordInput(['id' => 'pass-form','placeholder'=>'Ingresa tu nueva contraseña']) ?>
         <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> 
         <?= Html::label('Mostrar password', 'reveal-password') ?>
         <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repite tu nueva contraseña']) ?>   
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary', 'name' => 'cambiarpass-button']) ?>
            </div>
        </div>

     <?= $form->field($model, 'dni')->textInput(['placeholder'=>'DNI','autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Contraseña']) ?>
    <span id="reveal-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
     <?= $form->field($model, 'nuevo_password')->passwordInput(['id' => 'pass-form','placeholder'=>'Nueva contraseña']) ?>
     <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repite la nueva contraseña']) ?>
    <div class="form-group">
        <div class="col-lg-12">
           <?= Html::submitButton('Cambiar', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'cambiarpass-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
<?php

//js que controla la visualizacion del pass
$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#pass-form').attr('type',this.checked?'text':'password');})");
?>
