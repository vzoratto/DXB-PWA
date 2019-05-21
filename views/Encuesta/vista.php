<?php


/* @var $encuesta app\models\Encuesta */
/* @var $pregunta app\models\Pregunta */
/* @var $opcion app\models\RespuestaOpcion */

?>

<h2>Titulo de Encuesta: <?= $encuesta['encTitulo']?></h2>
<h4>Descripcion: <?= $encuesta['encDescripcion']?></h4>
<hr>
<?php foreach($pregunta as $valor):?>
    <h3> <?php $idPregunta=$valor['idPregunta']; ?></h3>
    <h3> <?= $valor['pregDescripcion']; ?></h3>

    <?php foreach($opcion as $clave=>$valor2):?>

        <?php foreach($valor2 as $unaOpc):?>

            <?php if($unaOpc['idPregunta']==$idPregunta):?>
            
                <h5> <?= $unaOpc['opRespvalor']; ?></h5>
            <?php endif;?>

        <?php endforeach;?>

    <?php endforeach?>
<hr>
<?php endforeach?>

