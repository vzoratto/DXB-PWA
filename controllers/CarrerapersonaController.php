<?php

namespace app\controllers;

use Yii;
use app\models\Carrerapersona;
use app\models\Carrerapersonasearch;
use app\models\Persona;
use app\models\Permiso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarrerapersonaController implements the CRUD actions for Carrerapersona model.
 */
class CarrerapersonaController extends Controller
{
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
     * Lists all Carrerapersona models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new Carrerapersonasearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $persona = new \app\models\Persona();
		
        return $this->render('index', [
            'searchModel' => $searchModel,
			'dataProvider'=> $dataProvider,
            'persona' => $persona
			
        ]);
    }
	public function actionKit()
    {
        $this->layout='/main3';
        $searchModel = new Carrerapersonasearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $persona = new \app\models\Persona();
		
        return $this->render('indexkit', [
            'searchModel' => $searchModel,
			'dataProvider'=> $dataProvider,
			
        ]);
    }

    /**
     * Displays a single Carrerapersona model.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idTipoCarrera, $idPersona)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        return $this->render('view', [
            'model' => $this->findModel($idTipoCarrera, $idPersona),
        ]);
    }

    /**
     * Creates a new Carrerapersona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = new Carrerapersona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Carrerapersona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idTipoCarrera, $idPersona)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $personaC = new Persona();
        $model = $personaC-> findOne(['idPersona'=>$idPersona]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idPersona' => $model->idPersona]);
        }

        return $this->render('updatepersona', [
            'model' => $model,'idTipoCarrera'=> $idTipoCarrera
        ]);
    }
	public function actionUpdatekit($idTipoCarrera, $idPersona)
    { 
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = $this->findModel($idTipoCarrera, $idPersona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['kit', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]);
        }

        return $this->render('updatekit', [
            'model' => $model,
        ]);
    }
	
    public function actionUpdatepersona($idTipoCarrera, $idPersona)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $personaC= new Persona();
        $model = $this->findModel($idTipoCarrera,$idPersona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]);
        }

        return $this->render('updatepersona', [
            'model' => $model,
        ]);
    }
	
	

    /**
     * Deletes an existing Carrerapersona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idTipoCarrera, $idPersona)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $this->findModel($idTipoCarrera, $idPersona)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Carrerapersona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return Carrerapersona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idTipoCarrera, $idPersona)
    {
        if (($model = Carrerapersona::findOne(['idTipoCarrera' => $idTipoCarrera, 'idPersona' => $idPersona])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
