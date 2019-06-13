<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CambiapassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cambiar Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cambiapass">
    <div class="form-group col-lg-6 col-md-offset-3" align="center">
        <h1><?= Html::encode($this->title) ?></h1>
        <img src="registro/iniciarsesion.png"  style="width: 150px;">
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

         <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingrese solo numeros, 8 caracteres','autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Ingresa 8 caracteres']) ?>
         
         <?= $form->field($model, 'nuevo_password')->passwordInput(['id' => 'pass-form','placeholder'=>'Repite tu password']) ?>
         <?= Html::checkbox('reveal-password', false, ['id' => 'reveal-password']) ?> 
         <?= Html::label('Mostrar password', 'reveal-password') ?>
         <?= $form->field($model, 'repite_password')->passwordInput(['placeholder'=>'Ingresa 8 caracteres']) ?>   
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton('Cambiar', ['class' => 'btn btn-primary', 'name' => 'cambiarpass-button']) ?>
            </div>
        </div>

<?php ActiveForm::end(); ?>
    </div>
</div>
<?php 
  
//js que controla la visualizacion del pass
$this->registerJs("jQuery('#reveal-password').change(function(){jQuery('#pass-form').attr('type',this.checked?'text':'password');})");
?>