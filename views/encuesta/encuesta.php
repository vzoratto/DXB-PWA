<?php

// Vista de la encuesta publicada en el proceso de inscripcion

use app\controllers\PreguntaController;
use app\controllers\RespuestaOpcionController;
use app\controllers\EncuestaController;

/* @var $this yii\web\View */
/* @var $encuesta app\models\Encuesta */
/* @var $pregunta app\models\Pregunta */
/* @var $opcion app\models\RespuestaOpcion */


?>
<!-- Busca la encuesta que esta activa para ser publicada -->
<?php $encuesta=EncuestaController::encuestaPublica(); ?>

<!-- Se buscan las preguntas que corresponden a la encuesta publica -->
<?php $pregunta=PreguntaController::entregaPreguntasXEncuesta($encuesta['idEncuesta']); ?>

<?php
$i=0;
        $opcion=[];

        // Recorre el listado de preguntas de la encuesta activa y arma un array con las opciones de respuesa de cada una
        foreach($pregunta as $unaPregunta){
            $opciones=RespuestaOpcionController::listaRespuestaOpcion($unaPregunta->idPregunta);
            $opcion[$i]=$opciones;
            $i++;
        }
?>

<h3> <?= $encuesta['encTitulo']?></h3>
<h5> <?= $encuesta['encDescripcion']?></h5>
<div id="error-encuesta" style="display: none">
    <p style="color: red">DEBES COMPLETAR LA ENCUESTA PARA CONTINUAR</p>

</div>
<hr>
<div class="encuesta-form">    
        
        <!-- por cada pregunta de la lista identifica el tipo de respuesta y renderiza la vista correspondiente
        pasando en cada caso las opciones de respuesta, id de la pregunta, instancia del modelo Formulario,
        instancia del modelo Respuesta y la pregunta -->
        <?php foreach($pregunta as $valor):?>
        <div class=" col-xs-12 col-sm-6">

            <div class="form-group ">
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
        <?php if(!$encuesta==[]):?>
            <!-- Si existe una encuesta publica, se incorpora el id de la misma a los datos del formulario
            caso contrario no se tiene en cuenta esta línea -->
            <?= $form->field($respuesta, 'idEncuesta')->hiddenInput(['value'=>$encuesta['idEncuesta']])->label(false) ?> 
        <?php endif?>

</div>
