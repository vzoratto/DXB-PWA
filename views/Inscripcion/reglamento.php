<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Personaemergencia */
/* @var $form yii\widgets\ActiveForm */
?>


<!-- vista del tab reglamento-->
<div class="reglamento">
  <div class="align-center">
      <?php
        echo \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
          'url' => '../../../Reglamento/Presentaciondelamateria.pdf', //url на ваш документ или http://example.com/test.odt
          'width'=>'65%',
          'height'=>'550px',
        ]);
      ?>
  </div>
<?php /*
   <div class="datosCaptcha" >
            <?= $form->field($persona, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                [
                    'siteKey' => '6LcaGKgUAAAAAHFPZSlm2jc_GeKUoccTzRkhUkjK', // unnecessary is reCaptcha component was set up
                ]
            ) ?>
   </div>
   */ ?>
<div id="reglamentoAceptado">
  <?= $form->field($carrerapersona, 'reglamentoAceptado')->checkbox(['label' => 'He leido y acepto los términos y condiciones', 'uncheck' => 0]); ?>
</div>
</div>

