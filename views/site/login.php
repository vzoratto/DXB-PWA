<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="form-group col-lg-6 col-md-offset-3" aling="center">
        <h1><?= Html::encode($this->title) ?></h1>
        <img src="registro/iniciarsesion.png"  style="width: 150px;">
    </div>
    <div class="form-group col-lg-6 col-md-offset-3">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingrese solo numeros, 8 caracteres','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'password',['inputOptions' => ['class' => 'form-control']])
            ->passwordInput(['placeholder'=>'Ingrese 8 caracteres'])?>
            
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton('Iniciar Sesion', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
            <p class="text-center">
                <?= Html::a('Olvidaste tu password?', ['site/recupass']) ?>
            </p>
            <p class="text-center">
                <?= Html::a('Cambiar password', ['site/cambiapass']) ?>
            </p>
            <p class="text-center">
                <?= Html::a('Si no estas registrado, REGISTRATE!', ['site/registro']) ?>
            </p>
<?php ActiveForm::end(); ?>
    </div>
</div>
  
