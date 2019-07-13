<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fichamedica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="captcha-form">


    <div class="datosCaptcha" >
        <?= $form->field($persona, 'reCaptcha')->widget(
            \himiklab\yii2\recaptcha\ReCaptcha2::className(),
            [
                'siteKey' => '6LcaGKgUAAAAAHFPZSlm2jc_GeKUoccTzRkhUkjK', // unnecessary is reCaptcha component was set up
            ]
        ) ?>


    </div>




</div>
