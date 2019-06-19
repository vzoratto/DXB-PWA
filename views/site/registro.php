
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\RegistroForm */
$this->title = 'Registrate';

?>
<section id="registro" style="background-image:url('assets/img/fondo.jpg');" class="full-section">
<div class="site-registro">
 <div class="row">
 <div class="container">
  <div class="col-xs-12 col-md-4 col-md-offset-4">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>Por favor llene los siguientes campos para registrarte:</p>
    <?php $form = ActiveForm::begin([
        'id' => 'registro-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
		
    ]); ?>
        <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingresa solo numeros, 8 caracteres','autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['id' => 'pass-form','placeholder'=>'Ingresa 8 caracteres']) ?>
        <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> 
        <?= Html::label('Mostrar password', 'reveal-password') ?>
        <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Repite tu password']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder'=>'Ingresa tu email','autofocus' => true]) ?>
    </div>
        <div class="col-xs-12 col-md-4 col-md-offset-4">   
                <div class="form-group">
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-medio btn-rounded btn-carrera', 'name' => 'registro-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
   </div> 
</div>
</section>
<?php
//js que controla la visualizacion del pass
$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#pass-form').attr('type',this.checked?'text':'password');})");
?>