<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Listadeespera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="listadeespera-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPersona')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
