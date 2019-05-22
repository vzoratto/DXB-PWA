<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Encuesta;
use app\models\Pregunta;
use app\models\RespuestaOpcion;
use app\models\Respuesta;


/**
 * Controlador utilizado para armar y mostrar las encuestas
 */

class VerencuestaController extends Controller{

    public function actionVerEncuesta()
    {
        $idEncuesta=$_REQUEST['idEncuesta'];

        $encuesta=Encuesta::findOne($idEncuesta);
        $pregunta=Pregunta::find()->where('idEncuesta= '.$idEncuesta)->all();
        $respuesta=new Respuesta();

        $i=0;
        $opcion=[];

        foreach($pregunta as $unaPregunta){
            $opciones=RespuestaOpcion::find()->where('idPregunta= '.$unaPregunta->idPregunta)->all();
            $opcion[$i]=$opciones;
            $i++;
        }

        return $this->render('@app/views/Encuesta/vista.php', [
            'encuesta'=>$encuesta,
            'pregunta'=>$pregunta,
            'opcion'=>$opcion,
            'respuesta'=>$respuesta,
            ]);
    }
}