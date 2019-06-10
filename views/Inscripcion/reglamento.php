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
      <?php
        echo \lesha724\documentviewer\ViewerJsDocumentViewer::widget([
          'url' => '../../../Reglamento/Presentaciondelamateria.pdf', //url на ваш документ или http://example.com/test.odt
          'width'=>'75%',
          'height'=>'550px',
        ]);
      ?>
    
</div>




</div>