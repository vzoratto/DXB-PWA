<?php

namespace app\controllers;

use Yii;
use app\models\Pregunta;
use app\models\PreguntaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Encuesta;
use app\models\EncuestaSearch;
use yii\filters\AccessControl;
use app\models\Permiso;

/**
 * PreguntaController implements the CRUD actions for Pregunta model.
 */
class PreguntaController extends Controller
{

    /**
     * Dado un idPregunta, devuelve el objeto Pregunta
     * @param Int $idPregunta
     * @return objet
     */
    public static function entregaPregunta($idPregunta){
        
        $unaPreg=new Pregunta();
        
        return $unaPreg->findOne($idPregunta);
  
    }
    /**
     * Dado el id de una encuesta, devuelve las preguntas de esa encuesta.
     * @param integer $idEncuesta
     * @return array
     */
    public static function entregaPreguntasXEncuesta($idEncuesta){
        
        $encuestas=Pregunta::find()->where(['idEncuesta'=>$idEncuesta])->all();
        
        return $encuestas;
  
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete'],
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
     * Lists all Pregunta models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new PreguntaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [
            'pageSize' => 10,
        ];
        $encuesta=null;

        if(isset($_REQUEST['idEncuesta'])){ //si recibe un idEncuesta pasa en dataProvider las preguntas solo de esa encuesta
            $dataProvider->query->andWhere('pregunta.idEncuesta = '.$_REQUEST['idEncuesta']);
            $dataProvider->pagination = [
                'pageSize' => 10,
            ];
            $encuesta=Encuesta::find()->where(['idEncuesta'=>$_REQUEST['idEncuesta']])->one();
        }
        if(isset($_REQUEST['idPregunta'])){ //si recibe un idEncuesta pasa en dataProvider las preguntas solo de esa encuesta
            $dataProvider->query->andWhere('pregunta.idPregunta = '.$_REQUEST['idPregunta']);
            $dataProvider->pagination = [
                'pageSize' => 10,
            ];
            $idEncuesta=PreguntaSearch::findOne($_REQUEST['idPregunta'])->idEncuesta;

            $encuesta=Encuesta::find()->where(['idEncuesta'=>$idEncuesta])->one();
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'encuesta'=>$encuesta,
        ]);
    }

    /**
     * Displays a single Pregunta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pregunta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }

        $id=$_REQUEST['id'];//recibe el idEncuesta.
        $encuesta=EncuestaSearch::find()->where(['idEncuesta'=>$id])->one();
        $encTipo=$encuesta->encTipo;


        $model = new Pregunta();

         if ($model->load(Yii::$app->request->post())) {
                
                $model->save();
                return $this->redirect(['respuestaopcion/define-opcion', 'id' => $model->idPregunta,]);
            }
            $model->idEncuesta=$id;
            return $this->render('create', [
                'model' => $model,
                'encTipo'=>$encTipo,
            ]);
    }

    /**
     * Updates an existing Pregunta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = $this->findModel($id);
        $model->encuesta; //agrega al modelo la encuesta a la que pertenece la pregunta a editar

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['pregunta/index', 'id' => $model->idPregunta]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pregunta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pregunta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pregunta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pregunta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
