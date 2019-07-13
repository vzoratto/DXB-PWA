<?php

// Renderiza la opcion texto de la encuesta

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $respuesta app\models\Respuesta */
/* @var $form yii\widgets\ActiveForm */

?>


<?= $form->field($respuesta, 'respValor')->textInput(['name'=>$valor['idPregunta']])->label(false); ?>