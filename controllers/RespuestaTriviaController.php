<?php

namespace app\controllers;

use Yii;
use app\models\RespuestaTrivia;
use app\models\RespuestaTriviaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Permiso;
use yii\filters\AccessControl;

/**
 * RespuestaTriviaController implements the CRUD actions for RespuestaTrivia model.
 */
class RespuestaTriviaController extends Controller
{
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
     * Lists all RespuestaTrivia models.
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

        $searchModel = new RespuestaTriviaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RespuestaTrivia model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RespuestaTrivia model.
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

        $idPregunta=$_REQUEST['idPregunta'];
        // echo '<pre>'; print_r(Yii::$app->request->post()); echo '</pre>';
        $model = new RespuestaTrivia();

        if ($model->load(Yii::$app->request->post())) {
            $resp=$model->respTriviaValor;
            $idPregunta=$model->idPregunta;
            //  echo '<br><br><br><br><pre>'; print_r($resp); echo '</pre>';
            foreach($resp as $valor){
                $laRespuesta=new RespuestaTrivia();
                $laRespuesta->respTriviaValor=$valor;
                $laRespuesta->idPregunta=$idPregunta;
                $laRespuesta->save();
            }
            return $this->redirect(['respuestaopcion/index', 'idPregunta' => $laRespuesta->idPregunta]);
        }

        $model->idPregunta=$idPregunta;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RespuestaTrivia model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRespTrivia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RespuestaTrivia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RespuestaTrivia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RespuestaTrivia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RespuestaTrivia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
