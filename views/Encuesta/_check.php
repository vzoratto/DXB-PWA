<?php
// Renderiza la vista de las opciones de checkbox de las encuestas

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
        <!-- Cada opcion de las opciones de respuesta se agrega a un array de opciones para el checkbox  -->
        <?php if($unaOpc['idPregunta']==$idPregunta):?>
            <?php array_push($resp, $unaOpc); ?>
        <?php endif;?>

    <?php endforeach;?>

<?php endforeach?>

<!-- Se da forma al array de datos de opciones -->
<?php $r=ArrayHelper::map($resp, 'idRespuestaOpcion', 'opRespvalor') ?>

<?= $form->field($respuesta, 'respValor')->checkboxList($r,['separator' => '<br>', 'name'=>$valor['idPregunta']])->label(false); ?>