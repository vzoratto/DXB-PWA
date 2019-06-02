<?php

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $encuesta app\models\Encuesta */
/* @var $pregunta app\models\Pregunta */
/* @var $opcion app\models\RespuestaOpcion */
/* @var $respuesta app\models\Respuesta */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $resp=[];?>

<?php foreach($opcion as $clave=>$valor2):?>
    
    <?php foreach($valor2 as $unaOpc):?>

        <?php if($unaOpc['idPregunta']==$idPregunta):?>
            <?php array_push($resp, $unaOpc); ?>
        <?php endif;?>

    <?php endforeach;?>

<?php endforeach?>

<?php $r=ArrayHelper::map($resp, 'idRespuestaOpcion', 'opRespvalor') ?>

<?= $form->field($respuesta, 'respValor')->radioList( $r,['separator' => '<br>', 'name'=>$valor['idPregunta']] )->label(false);?>