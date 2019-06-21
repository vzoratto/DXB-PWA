<?php

namespace app\controllers;

use Yii;
use app\models\Respuestaopcion;
use app\models\RespuestaopcionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PreguntaSearch;
use yii\filters\AccessControl;
use app\models\Permiso;
use app\models\Pregunta;

/**
 * RespuestaopcionController implements the CRUD actions for Respuestaopcion model.
 */
class RespuestaopcionController extends Controller
{
    /**
     * dado un idPregunta, devuelve un array con las opciones de respuesta de la misma.
     * @param integer $idPregunta
     * @return array
     */
    public static function listaRespuestaOpcion($idPregunta){
        $opciones=RespuestaOpcion::find()->where('idPregunta= '.$idPregunta)->all();
        return $opciones;
    }
    /**
     * Accion para cargar a la BD las opciones de la lista desplegable
     */
    public function actionCreaDrop()
    {
        $opciones=null;
        $model = new RespuestaOpcion();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->idRespuestaOpcion="";
            $model->opRespvalor="";

            // Busca las opciones que ya estan cargadas y arma un array con las mismas
            $opciones=RespuestaopcionSearch::find()->where(['idPregunta'=>$model->idPregunta])->asArray()->all();
            return $this->render('creaDrop', ['model' => $model, 'opciones'=>$opciones]);
        }
        
        return $this->render('creaDrop', [
            'model' => $model,
            'opciones'=>$opciones,
        ]);
    }
    
    /**
     * Accion para cargar a la BD las opciones del CheckBox
     */
    public function actionCreaCheck()
    {
        $opciones=null;
        $model = new RespuestaOpcion();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->idRespuestaOpcion="";
            $model->opRespvalor="";
            $opciones=RespuestaopcionSearch::find()->where(['idPregunta'=>$model->idPregunta])->asArray()->all();
            return $this->render('creaCheck', ['model' => $model, 'opciones'=>$opciones]);
        }
        
        return $this->render('creaCheck', [
            'model' => $model, 
            'opciones'=>$opciones,
        ]);
    }
    
    /**
     * Accion para cargar a la BD las opciones del RadioButton
     */
    public function actionCreaRadio()
    {
        $opciones=null;
        $model = new RespuestaOpcion();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->idRespuestaOpcion="";
            $model->opRespvalor="";
            $opciones=Respuestaopcion::find()->where(['idPregunta'=>$model->idPregunta])->asArray()->all();
            return $this->render('creaRadio', ['model' => $model, 'opciones'=>$opciones]);
        }
        
        return $this->render('creaRadio', [
            'model' => $model,
            'opciones'=>$opciones
        ]);
    }
    
    
    
    /**
     * Recibe por get el id de la pregunta y define que tipo de respuesta de desea para la pregunta
     * En base a esto redirecciona a la opcion que corresponde.
     * @return string
     */
    public function actionDefineOpcion(){
        
        $idPregunta=$_REQUEST['id'];
        $opciones=null;
        $tipo=PreguntaSearch::findOne($idPregunta);
        $model=new RespuestaOpcion();
        
        
        if($tipo->idRespTipo == 1){
            return $this->redirect(['pregunta/create', 'model'=>$model,'id'=>$tipo->idEncuesta, 'idPregunta'=>$tipo->idPregunta]);
        }elseif ($tipo->idRespTipo == 2){
            return $this->render('creaDrop', ['model'=>$model,'idPregunta'=>$tipo->idPregunta, 'opciones'=>$opciones]);
        }elseif ($tipo->idRespTipo == 3){
            return $this->render('creaCheck', ['model'=>$model,'idPregunta'=>$tipo->idPregunta, 'opciones'=>$opciones]);
        }elseif ($tipo->idRespTipo == 4){
            return $this->render('creaRadio', ['model'=>$model,'idPregunta'=>$tipo->idPregunta, 'opciones'=>$opciones]);
        }
        
        return $this->render('error', ['idPregunta'=>$idPregunta, 'tipo'=>$tipo]);
    }
    

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

            'access'=>[
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('administrador') && Permiso::requerirActivo(1);
                        }
                    ],
                    [
                        'actions' => [],
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
     * Lists all Respuestaopcion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RespuestaopcionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination=[
            'pageSize'=>15,
        ];
        $pregunta=null;

        if(isset($_REQUEST['idPregunta'])){
            $dataProvider->query->andWhere('respuesta_opcion.idPregunta='.$_REQUEST['idPregunta']);
            $pregunta=Pregunta::find()->where(['idPregunta'=>$_REQUEST['idPregunta']])->one();
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pregunta'=>$pregunta,
        ]);
    }

    /**
     * Displays a single Respuestaopcion model.
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
     * Creates a new Respuestaopcion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(isset($_REQUEST['idPregunta'])){
            $idPregunta=$_REQUEST['idPregunta'];
            $pregunta=PreguntaSearch::find()->where(['idPregunta'=>$idPregunta])->one();
            $opciones=RespuestaopcionSearch::find()->where(['idPregunta'=>$idPregunta])->asArray()->all();
        }else{
            $pregunta=null;
            $opciones=null;
        }

        $model = new Respuestaopcion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idPregunta'=>$pregunta->idPregunta,'id' => $model->idRespuestaOpcion]);
        }

        return $this->render('create', [
            'model' => $model,
            'pregunta'=>$pregunta,
            'opciones'=>$opciones,
        ]);
    }

    /**
     * Updates an existing Respuestaopcion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(isset($_REQUEST['pregunta'])){
            $pregunta=$_REQUEST['pregunta'];
        }else{
            $pregunta=null;
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idRespuestaOpcion]);
        }

        return $this->render('update', [
            'model' => $model,
            'pregunta'=>$pregunta,
        ]);
    }

    /**
     * Deletes an existing Respuestaopcion model.
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
     * Finds the Respuestaopcion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Respuestaopcion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Respuestaopcion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
