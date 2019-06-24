<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cover-background contenedor-full full-section" style="background-image:url('assets/img/fondo.jpg');">
    <div class="box-bd no-label" align="center">
      <img class="center" src="assets/img/logo-color.png" alt="logo color">
      <p><?= Html::encode($this->title) ?></p>
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

        <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingresa tu DNI','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'password',['inputOptions' => ['class' => 'form-control m-0']])
            ->passwordInput(['placeholder'=>'Ingresa tu contraseña'])?>
            <p class="text-center">
                <?= Html::a('Olvidaste tu contraseña?', ['site/recupass']) ?>
            </p>

        <div class="form-group">
            <?= Html::submitButton('Iniciar Sesion', ['class' => 'btn btn-grande btn-rounded btn-carrera submitbutton width-100', 'name' => 'login-button']) ?>
        </div>
            <p class="text-center">
                <?= Html::a('No estas registrado? REGISTRATE!', ['site/registro']) ?>
            </p>
            <?php ActiveForm::end(); ?>
    </div>
</div>
