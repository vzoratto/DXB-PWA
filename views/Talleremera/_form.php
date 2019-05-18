<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Talleremera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="talleremera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'deshabilitado')->textInput() ?>

    <?= $form->field($model, 'talleRemera')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
