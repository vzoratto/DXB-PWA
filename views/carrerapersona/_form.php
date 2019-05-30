<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carrerapersona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idTipoCarrera')->textInput() ?>

    <?= $form->field($model, 'idPersona')->textInput() ?>

    <?= $form->field($model, 'reglamentoAceptado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
