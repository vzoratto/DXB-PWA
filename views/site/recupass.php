<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RecupassForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Recuperar Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-recupass">
    <div class="form-group col-lg-6 col-md-offset-3" align="center">
        <h1><?= Html::encode($this->title) ?></h1>
        <img src="registro/iniciarsesion.png"  style="width: 150px;">
    </div>
    <div class="form-group col-lg-6 col-md-offset-3">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'recupass-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

         <?= $form->field($model, 'dni')->textInput(['placeholder'=>'Ingresa tu dni','autofocus' => true, 'class' => 'form-control']) ?>

         <?= $form->field($model, 'email',['inputOptions' => ['class' => 'form-control']])
            ->textinput(['placeholder'=>'Ingresa tu email'])?>
            
             
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton('Recuperar', ['class' => 'btn btn-primary', 'name' => 'recupass-button']) ?>
            </div>
        </div>

<?php ActiveForm::end(); ?>
    </div>
</div>
  
