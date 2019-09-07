<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Encuesta;
use app\models\Pregunta;
use app\models\RespuestaOpcion;
use app\models\Respuesta;
use app\models\EncuestaSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Permiso;

/**
 * Controlador utilizado para armar y mostrar las encuestas
 */

class BotController extends Controller{
    public function actionIndex(){
        function sendMessage($chatId, $text)
        {

            $TOKEN = "922193529:AAFA8WkjqKz32ND048tOMBhd1Cqeo0gXVrc";
            $TELEGRAM = "https://api.telegram.org:443/bot$TOKEN";

            $query = http_build_query(array(
                'chat_id'=> $chatId,
                'text'=> $text,
                'parse_mode'=> "Markdown", // Optional: Markdown | HTML
            ));

            $response = file_get_contents("$TELEGRAM/sendMessage?$query");
            return $response;
        }

        //https://api.telegram.org/bot922193529:AAFA8WkjqKz32ND048tOMBhd1Cqeo0gXVrc/setwebhook?url=https://dxb.fi.uncoma.edu.ar/chatbot/webhook.php

        $request = file_get_contents("php://input");

        $date = date('Y-m-d H:i:s');

        $content = "$date\n$request\n\n";

        $ruta='archivo/pagoinscripcion/';

        //file_put_contents($ruta."webhook.log", $content, FILE_APPEND);

        //$request = json_decode($request);
        //sendMessage($request->message->chat->id,'Hola '.$request->message->from->first_name);

        //$json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $request->message->text);


        //$jsonArr=json_decode($json);

        //$salida="";
        //foreach ($jsonArr as $value){
          //  $salida.=$value->numEquipo.', ';
        //}
        //sendMessage($request->message->chat->id,'Se cargaron '.$salida. ' Equipos.');
        /*sendMessage($request->message->chat->id,'mensaje '.$json);

        sendMessage($request->message->chat->id,'mensaje '.$jsonArr[0]->numEquipo);
        */

    }

}

