<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use app\models\Usuario;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $model app\models\Gestores */
/* @var $form yii\widgets\ActiveForm */

if($rol=='admin'){
    $this->title = 'Crear permisos administrador';
}elseif($rol=='gest'){
    $this->title = 'Crear permisos gestor';
}
?>
<div class="gestores-altagestores reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'method'=>'post',
        "action"=>"index.php?r=gestores%2Fcargagestores",
              "enableClientValidation"=>true,
              ]); ?>

    <?= $form->field($model, 'nombreGestor')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'apellidoGestor')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model1, 'dniUsuario')->textInput(['id' => 'usu-form']) ?>
    <?= $form->field($model1, 'mailUsuario')->textInput(['maxlength' => true])?>
    <!--<?= $form->field($model, 'telefonoGestor')->textInput(['maxlength' => true]) ?>-->
    <?= $form->field($model, 'telefonoGestor')->widget(PhoneInput::className(), [
                'jsOptions' => [
                'allowExtensions' => true,
                'preferredCountries' => ['ar', 'br', 'cl', 'uy', 'py', 'bo'],
                'nationalMode' => false,
                ]
            ])->label('') ?> 

    <!--<?= $form->field($model, 'idUsuario')->textInput() ?>-->
    <!--<?= $form->field($model1, 'authkey')->textInput(['maxlength' => true]) ?>-->
    <!--<?= $form->field($model1, 'activado')->textInput() ?>-->
    
    <?php
         if ($rol=='admin'){  
            echo $form->field($model1, 'idRol')->hiddenInput(['value'=>2])->label(false);
          }elseif($rol=='gest'){
	         echo $form->field($model1, 'idRol')->hiddenInput(['value'=>3])->label(false);
         }
	    ?>
       
    <div class="form-group">
        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-success']);?>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
