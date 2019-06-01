<?php
use app\controllers\PreguntaController;
use app\controllers\RespuestaController;
use app\controllers\RespuestaopcionController;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\controllers\EncuestaController;

/* @var $this yii\web\View */
/* @var $encuesta app\models\Encuesta */
/* @var $pregunta app\models\Pregunta */
/* @var $opcion app\models\RespuestaOpcion */


?>
<?php $encuesta=EncuestaController::encuestaPublica();  ?>
<?php $pregunta=PreguntaController::entregaPreguntasXEncuesta($encuesta['idEncuesta']);?>

<?php
$i=0;
        $opcion=[];

        foreach($pregunta as $unaPregunta){
            $opciones=RespuestaopcionController::listaRespuestaOpcion($unaPregunta->idPregunta);
            $opcion[$i]=$opciones;
            $i++;
        }
?>

<!-- <H1>Contenido en desarrollo &#128077;</H1> -->

<?php echo Html::a('Ir a generacion de encuesta', Url::toRoute('encuesta/create'), ['class'=>'btn btn-primary btn-sm'])?>

<h3> <?= $encuesta['encTitulo']?></h3>
<h5> <?= $encuesta['encDescripcion']?></h5>
<hr>
<div class="encuesta-form">    
        
        <?php foreach($pregunta as $valor):?>
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
        
        <?php endforeach?>

        <?= $form->field($respuesta, 'idEncuesta')->hiddenInput(['value'=>$encuesta['idEncuesta']])->label(false) ?> 


</div>
