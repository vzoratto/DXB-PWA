<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gruposanguineo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gruposanguineo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipoGrupoSanguineo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
