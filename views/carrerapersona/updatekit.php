<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

$this->title = ' ' . $model->persona->nombrePersona." ".$model->persona->apellidoPersona;
?>
<div class="carrerapersona-update reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
	 <?= $form->field($model ,'retiraKit')->dropDownList( array("1"=>"si","2"=>"no"), ['class'=>'sm-width-40 width-40 block', 'prompt' => 'Seleccione' ])->label('Retira Kit'); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success'],['carrerapersona/index']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
