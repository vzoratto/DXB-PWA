<?php

use yii\helpers\Url;
use app\controllers\PreguntaController;
use app\controllers\RespuestaTriviaController;

?>
<br><br><br>
<div class="container reglamento-container">
    <h2>Resultado trivia:</h2>
    <?php foreach($resultadoTrivia as $clave=>$preg): ?>
        <h3><?= PreguntaController::entregaPregunta(array_key_first($preg))['pregDescripcion'] ?></h3>
        <?php if($preg[array_key_first($preg)]==1):?>
            <h4 class="alert alert-success">Respuesta Correcta</h4>
        <?php else: ?>
            <div class="alert alert-danger">
            <h4>Respuesta Incorrecta</h4>
            <h5>Respuesta Correcta :</h5>
            <?php $respCor= RespuestaTriviaController::getRespCorrectas(array_key_first($preg)) ?>
            <?php foreach($respCor as $clave=>$resp): ?>
                - <?= $resp['respTriviaValor'] ?><br>
            <?php endforeach ?>
            </div>
        <?php endif ?>
        <hr>
    <?php endforeach ?>

    <!-- <a title="Volver a la responder trivia" class="btn btn-default" href="<?= Url::toRoute('encuesta/trivia')?>">Volver a responder trivia</a> -->
    <a title="Volver a Inicio" class="btn btn-default" href="<?= Url::toRoute('site/index')?>">Aceptar</a>
</div>