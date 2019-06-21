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
use yii\helpers\Url;

/**
 * Controlador utilizado para armar y mostrar las encuestas
 */

class VerencuestaController extends Controller{

    /**
     * Accion que cambia el valor del campo encPublica para seleccionar cual sera visible en el tas de inscripcion
     */
    public function actionPublicarEncuesta(){
        
        $idEncuesta=$_REQUEST['idEncuesta'];
        $encuesta=Encuesta::findOne($idEncuesta);
        $tipo=$encuesta->encTipo;
        $conexion=\Yii::$app->db;
        //Cambia el valor de encPublica en todos los campos a 0 y luego le da el valor 1 a la encuesta que seleccionamos.
        $conexion->createCommand()->update('encuesta', ['encPublica'=>0], ['encTipo'=>$tipo])->execute();
        $conexion->createCommand()->update('encuesta', ['encPublica'=>1], ['idEncuesta'=>$idEncuesta])->execute();       
        
        $searchModel = new EncuestaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // Realiza los cambios en encPublica y vuelve al controlador encuesta, accion index
        return $this->redirect(['encuesta/index', [ 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ],
        ]);
    }

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

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['publicarEncuesta','verEncuesta'],
                'rules' => [
                    [
                        'actions' => ['publicarEncuesta','verEncuesta'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('administrador') && Permiso::requerirActivo(1);
                        }
                    ],
                    [
                        'actions' => ['publicarEncuesta','verEncuesta'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('gestor') && Permiso::requerirActivo(1);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
}