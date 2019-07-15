<?php

namespace app\controllers;

use Yii;
use app\models\Encuesta;
use app\models\EncuestaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Permiso;
use app\models\Respuesta;
use app\models\Persona;
use yii\db\Query;
use yii\base\Exception;
use app\models\RespuestaOpcion;
use app\models\RespuestaSearch;
use yii\helpers\Url;
use app\models\RespuestaTriviaSearch;
use app\models\RespuestaOpcionSearch;

/**
 * EncuestaController implements the CRUD actions for Encuesta model.
 */
class EncuestaController extends Controller
{
    /**
     * Muestra la trivia para contestar
     * @return mixed
     */
    public function actionTrivia()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $respuestas=Yii::$app->request->post();
        $persona= Persona::findOne(['idUsuario'=>$_SESSION['__id']]);
        $idPersona=$persona['idPersona'];

        $respuesta=new Respuesta();
        if($respuestas){
            $transaction=Yii::$app->db->beginTransaction();
            try{
                
                
                foreach($respuestas as $clave=>$valor){

                    if(is_numeric($clave)){//solo toma las valores de clave numerico que son los items que tienen datos de respuesta en el array. Esta $clave es el id de la pregunta
                        // $tieneRespuesta=RespuestaSearch::find()->where(['idPregunta'=>$clave,'idPersona'=>$idPersona])->asArray()->all();
                        // if($tieneRespuesta!=null && $tieneRespuesta!=[]){
                        //     $mensaje="ya habías contestado esta trivia anteriormente. Muchas gracias.";
                        //     $mensaje.="<meta http-equiv='refresh' content='5; ".Url::toRoute("site/index")."'>";
                        //     return $this->render('triviacompleta',['mensaje'=>$mensaje]);
                        // }
                        if(is_array($valor)){
                            foreach($valor as $unValor){//Si la repuesta es multiple, recorre el array de esa respuesta para guardar cada uno de los valores
                                if(is_numeric($unValor)){//Si $unValor no es un string, entonces es el id de la opcion de respuesta
                                    $opcion=RespuestaOpcion::findOne($unValor);//busca la opcion de respuesta que corresponde
                                    $resp['respValor']=$opcion->opRespvalor;
                                }else{//Si la respuesta es un string, entonces guarda directamente la respuesta
                                    $resp['respValor']=$unValor;
                                }
                                $resp['idPregunta']=$clave;
                                $resp['idPersona']=$idPersona;
                                $model=new Respuesta();//Genera modelo, asigna valores y guarda
                                $model->respValor=$resp['respValor'];
                                $model->idPregunta=$resp['idPregunta'];
                                $model->idPersona=$resp['idPersona'];
                                $encuestaGuardada=$model->save();
                            }
                        }else{//Si la respuesta no es multiple, guarda la la respuesta
                            if(is_numeric($valor)){//Si la respuesta no es un string, entonces es el id de la opcion de respuesta
                                $opcion=RespuestaOpcion::findOne($valor);//busca la opcion de respuesta que corresponde
                                $resp['respValor']=$opcion->opRespvalor;
                            }else{//Si la respuesta es un string, entonces guarda directamente la respuesta
                                $resp['respValor']=$valor;
                            }
                            $resp['idPregunta']=$clave;
                            $resp['idPersona']=$idPersona;

                            $model=new Respuesta();//Genera modelo, asigna valores y guarda
                            $model->respValor=$resp['respValor'];
                            $model->idPregunta=$resp['idPregunta'];
                            $model->idPersona=$resp['idPersona'];
                            $encuestaGuardada=$model->save();
                        }
                    }    
                }
            
                $transaction->commit();
                $resultadoTrivia=$this->comparaResultados($respuestas);
                return $this->render('verResultadoTrivia',['resultadoTrivia'=>$resultadoTrivia]);

            }catch(Exception $e){
                $transaction->rollBack();

                if(!$encuestaGuardada){
                    yii::$app->session->setFlash('error', 'Las respuestas no se pudieron guardar. Por favor, intente nuevamente');
                }
            }
        }

        return $this->render('trivia', ['respuesta'=>$respuesta]);
    }

    /**
     * Recibe array de respuestas a las trivias y devuelve array con verdadero o falso segun esten bien respondidas.
     * @param array $respuestas
     * @return array
     */
    private function comparaResultados($respuestas){
        $r=[];
        foreach($respuestas as $clave=>$valor){
            if (is_numeric($clave)){//Si la clave es numerica entonces es el idPregunta
                if(is_array($valor)){//toma las respuestas que son multiples
                    $respUsu=[];
                    foreach($valor as $key1=>$opcion1){//genera un array de los valores de las respuestas del usuario
                        $opciones=RespuestaOpcionSearch::findOne($opcion1);
                        array_push($respUsu, $opciones->opRespvalor);
                    }
                   
                    $respCorrecta=RespuestaTriviaSearch::find()->where(['idPregunta'=>$clave])->asArray()->all();
                    $respCorre=[];
                    foreach($respCorrecta as $key=>$opcion){//Genera un array con los valores de las respuestas correctas
                        array_push($respCorre, $opcion['respTriviaValor']);
                    }
                    
                }else{
                    $respUsu=[];
                    
                    $opciones=RespuestaOpcionSearch::findOne($valor);
                    array_push($respUsu, $opciones->opRespvalor);
                  
                    $respCorrecta=RespuestaTriviaSearch::find()->where(['idPregunta'=>$clave])->asArray()->all();
                    $respCorre=[];
                    foreach($respCorrecta as $key=>$opcion){
                        array_push($respCorre, $opcion['respTriviaValor']);
                    }
                }
                echo '<br><br><br><pre>respondio';print_r($respUsu);echo '</pre>';
                echo '<pre>respuesta correcta';print_r($respCorre);echo '</pre>';

                if($respUsu==$respCorre){
                    $array=array($clave=>1);
                    array_push($r,$array);
                }else{
                    $array=array($clave=>0);
                    array_push($r,$array);
                }

            }
        }
        return $r;
    }


    /**
     * Recibe las respuestas de una pregunta de trivia y devuelve verdadero si la/las respuestas son correctas
     * de lo contrario devuelve falso.
     * @param mixed $respuesta
     * @return boolean
     */
    private function respuestaCorrecta($respuesta){
        $respCorrecta=RespuestaTriviaSearch::find()->where()->asArray()->all();

        if (is_array($respuesta)){
            
        }
    }

    /**
     * Devuelve el elemento Encuesta que este activo para ser publicado
     */
    public static function encuestaPublica(){
        return Encuesta::find()->where(['encPublica'=>1, 'encTipo'=>'encuesta'])->one();
    }

    /**
     * Devuelve el elemento Trivia que este activo para ser publicado
     */
    public static function triviaPublica(){
        return Encuesta::find()->where(['encPublica'=>1, 'encTipo'=>'trivia'])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete', ],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('administrador') && Permiso::requerirActivo(1);
                        }
                    ],
                    [
                        'actions' => ['index','view','create','update','delete'],
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

    /**
     * Lists all Encuesta models.
     * @return mixed
     */
    public function actionIndex()
    {   if(Permiso::requerirRol('administrador')){
        $this->layout='/main2';
    }elseif(Permiso::requerirRol('gestor')){
        $this->layout='/main3';
    }
        $searchModel = new EncuestaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination=[
            'pageSize'=>10,
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Encuesta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   if(Permiso::requerirRol('administrador')){
        $this->layout='/main2';
    }elseif(Permiso::requerirRol('gestor')){
        $this->layout='/main3';
    }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Encuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   if(Permiso::requerirRol('administrador')){
        $this->layout='/main2';
    }elseif(Permiso::requerirRol('gestor')){
        $this->layout='/main3';
    }
        $model = new Encuesta();

        if ($model->load(Yii::$app->request->post())) {
            $model->encTipo=Yii::$app->request->post()['encTipo'];
            $model->encPublica=0;
            if($model->save()){
                return $this->redirect(['pregunta/create', 'id' => $model->idEncuesta]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Encuesta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   if(Permiso::requerirRol('administrador')){
        $this->layout='/main2';
    }elseif(Permiso::requerirRol('gestor')){
        $this->layout='/main3';
    }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idEncuesta]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Encuesta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   if(Permiso::requerirRol('administrador')){
        $this->layout='/main2';
    }elseif(Permiso::requerirRol('gestor')){
        $this->layout='/main3';
    }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Encuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Encuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {   if(Permiso::requerirRol('administrador')){
        $this->layout='/main2';
    }elseif(Permiso::requerirRol('gestor')){
        $this->layout='/main3';
    }
        if (($model = Encuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
