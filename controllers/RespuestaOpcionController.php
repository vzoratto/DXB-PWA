<?php

namespace app\controllers;

use Yii;
use app\models\Respuestaopcion;
use app\models\RespuestaopcionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PreguntaSearch;

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
        $model = new RespuestaOpcion();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->idRespuestaOpcion="";
            $model->opRespvalor="";
            return $this->render('creaDrop', ['model' => $model]);
        }
        
        return $this->render('creaDrop', [
            'model' => $model,
        ]);
    }
    
    /**
     * Accion para cargar a la BD las opciones del CheckBox
     */
    public function actionCreaCheck()
    {
        $model = new RespuestaOpcion();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->idRespuestaOpcion="";
            $model->opRespvalor="";
            return $this->render('creaCheck', ['model' => $model]);
        }
        
        return $this->render('creaCheck', [
            'model' => $model,
        ]);
    }
    
    /**
     * Accion para cargar a la BD las opciones del RadioButton
     */
    public function actionCreaRadio()
    {
        $model = new RespuestaOpcion();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->idRespuestaOpcion="";
            $model->opRespvalor="";
            return $this->render('creaRadio', ['model' => $model]);
        }
        
        return $this->render('creaRadio', [
            'model' => $model,
        ]);
    }
    
    
    
    /**
     * Recibe por get el id de la pregunta y define que tipo de respuesta de desea para la pregunta
     * En base a esto redirecciona a la opcion que corresponde.
     * @return string
     */
    public function actionDefineOpcion(){
        
        $idPregunta=$_REQUEST['id'];
        
        $tipo=PreguntaSearch::findOne($idPregunta);
        $model=new RespuestaOpcion();
        
        
        if($tipo->idRespTipo == 1){
            return $this->redirect(['pregunta/create', 'model'=>$model,'id'=>$tipo->idEncuesta, 'idPregunta'=>$tipo->idPregunta]);
        }elseif ($tipo->idRespTipo == 2){
            return $this->render('creaDrop', ['model'=>$model,'idPregunta'=>$tipo->idPregunta]);
        }elseif ($tipo->idRespTipo == 3){
            return $this->render('creaCheck', ['model'=>$model,'idPregunta'=>$tipo->idPregunta]);
        }elseif ($tipo->idRespTipo == 4){
            return $this->render('creaRadio', ['model'=>$model,'idPregunta'=>$tipo->idPregunta]);
        }
        
        return $this->render('error', ['idPregunta'=>$idPregunta, 'tipo'=>$tipo]);
    }
    

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $model = new Respuestaopcion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRespuestaOpcion]);
        }

        return $this->render('create', [
            'model' => $model,
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRespuestaOpcion]);
        }

        return $this->render('update', [
            'model' => $model,
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
