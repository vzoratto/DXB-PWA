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



/**
 * EncuestaController implements the CRUD actions for Encuesta model.
 */
class EncuestaController extends Controller
{
    /**
     * Devuelve el elemento Encuesta que este activo para ser publicado
     */
    public static function encuestaPublica(){
        return Encuesta::find()->where(['encPublica'=>1, 'encTipo'=>'encuesta'])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
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
