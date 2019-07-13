<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\RegistroForm */
$this->title = 'Registrate';
?>
<section id="registro" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
  <div class="box-bd no-label" align="center"> 
     <img class="center" src="assets/img/logo-color.png" alt="">

    <p><?= Html::encode($this->title) ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'registro-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <figure>
        <?= $form->field($model, 'dni')->textInput(['placeholder'=>'DNI','autofocus' => true]) ?>
        <figcaption><strong>DNI: S&oacute;lo n&uacute;meros, sin puntos</strong></figcaption>
        </figure>
        <?= $form->field($model, 'password')->passwordInput(['id' => 'password-field','placeholder'=>'Contraseña']) ?>
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repetir contraseña']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder'=>'Email','autofocus' => true]) ?>

        <div class="form-group">

          <?= Html::submitButton('Registrate', ['class' => 'btn btn-medio btn-rounded btn-carrera width-100', 'name' => 'registro-button']) ?>

          <?php ActiveForm::end(); ?>
        </div>
        <?php if (Yii::$app->session->hasFlash('registroFormSubmitted')): ?>
        <div class="alert alert-success" align="center">
           Enviamos un email de verificación y/o activación a tu correo, ábrelo para activar tu cuenta"
        </div>
        <?php endif; ?>
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