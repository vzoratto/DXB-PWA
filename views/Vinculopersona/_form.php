<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vinculopersona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vinculopersona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombreVinculo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
