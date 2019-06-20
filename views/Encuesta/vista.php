<?php

// muestra una vista de como quedara publicada la encuesta, solamente la muestra, no se puede con este script cargar datos a la base de datos

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $encuesta app\models\Encuesta */
/* @var $pregunta app\models\Pregunta */
/* @var $opcion app\models\RespuestaOpcion */

?>

<h2>Titulo de Encuesta: <?= $encuesta['encTitulo']?></h2>
<h4>Descripcion: <?= $encuesta['encDescripcion']?></h4>
<hr>

<div class="encuesta-form">
    <?php  $form=ActiveForm::begin(); ?>
        
      
        <?php foreach($pregunta as $valor):?>
        <div class=" col-xs-12 col-sm-6"> 
            <div class="form-group">
            <h3> <?php $idPregunta=$valor['idPregunta']; ?></h3>
            <h3> <?= $valor['pregDescripcion']; ?></h3>

            <?php if($valor['idRespTipo']==1){
                    echo $this->render('_texto',[
                        'opcion'=>$opcion,
                        'idPregunta'=>$idPregunta,
                        'form'=>$form,
                        'respuesta'=>$respuesta,
                        'valor'=>$valor,
                    ]);
                    

                }elseif($valor['idRespTipo']==2){
                    echo $this->render('_drop', [
                        'opcion'=>$opcion,
                        'idPregunta'=>$idPregunta,
                        'form'=>$form,
                        'respuesta'=>$respuesta,
                        'valor'=>$valor,
                        ]);
                       

                }elseif($valor['idRespTipo']==3){
                    echo $this->render('_check', [
                        'opcion'=>$opcion,
                        'idPregunta'=>$idPregunta,
                        'form'=>$form,
                        'respuesta'=>$respuesta,
                        'valor'=>$valor,
                        ]);
                       

                }elseif($valor['idRespTipo']==4){
                    
                    echo $this->render('_radio', [
                        'opcion'=>$opcion,
                        'idPregunta'=>$idPregunta,
                        'form'=>$form,
                        'respuesta'=>$respuesta,
                        'valor'=>$valor,
                        ]);
                      
                        
                }
                 
            ?>
            </div>
        
        </div>
        <?php endforeach?>

        <?= $form->field($respuesta, 'idEncuesta')->hiddenInput(['value'=>$encuesta['idEncuesta']])->label(false) ?> 
        
        <div class="form-group col-xs-12">
            <?= Html::a('Volver a Encuestas', ['encuesta/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    
    <?php ActiveForm::end(); ?>

</div>
