<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-group col-lg-6 col-md-offset-3" align="center">

      <img src="registro/registro.png" style="width: 150px;">

</div>

<div class="site-registro">
  <div class="form-group col-lg-6 col-md-offset-3" align="center">
    <h1><?= Html::encode($this->title) ?></h1>

    <h1><?= $mensaje ?></h1>
   </div>
    
    <div class="form-group col-lg-6 col-md-offset-3" align="center">
    <?php $form = ActiveForm::begin([
        'id' => 'registro-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
		'enableClientValidation' => true,
    ]); ?>
        
        <?= $form->field($model, 'dni')->textInput(['autofocus' => true]) ?>
        
        <?= $form->field($model, 'password')->textInput(['autofocus' => true]) ?>
        
        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        
  </div>      
		
		<div class="form-group">
            <div class="col-lg-6 col-md-offset-1" align="center">
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary', 'name' => 'registro-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

 
</div>
