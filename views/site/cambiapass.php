<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CambiapassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambiar Contraseña';

$usu=Yii::$app->user->identity->dniUsuario;
?>
<div class="site-cambiapass">
<section id="cambiapass" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
<div class="box-bd no-label" align="center">
     <img class="center" src="assets/img/logo-color.png" alt="">
        <p><?= Html::encode($this->title) ?></p>

        <?php
        $form = ActiveForm::begin([
                    'id' => 'cambiapass-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ]
        ]);
        ?>

     <?= $form->field($model, 'dni')->textInput(['value'=>$usu,'readonly'=> true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['id' => '','placeholder'=>'Contraseña']) ?>
     <?= $form->field($model, 'nuevo_password')->passwordInput(['id' => 'password-field','placeholder'=>'Nueva contraseña']) ?>
     <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
     <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repite la nueva contraseña']) ?>
    <div class="form-group">
        <div class="col-lg-12">
           <?= Html::submitButton('Cambiar', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'cambiarpass-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
  </div>

</section>
<?php

//js que controla la visualizacion del pass

$this->registerJs("$('.toggle-password').click(function() {

    $(this).toggleClass('fa-eye fa-eye-slash');
    var input = $($(this).attr('toggle'));
    if (input.attr('type') == 'password') {
      input.attr('type', 'text');
    } else {
      input.attr('type', 'password');
    }
  });");

?>
