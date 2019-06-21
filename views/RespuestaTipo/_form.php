<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Respuestatipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="respuestatipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'respTipoDescripcion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
