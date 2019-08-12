<?php

namespace app\controllers;

use Yii;
use app\models\Estadopago;
use app\models\EstadopagoSearch;
use app\models\Persona;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Permiso;

/**
 * EstadopagoController implements the CRUD actions for Estadopago model.
 */
class EstadopagoController extends Controller
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
     * Lists all Estadopago models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new EstadopagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estadopago model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
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
     * Creates a new Estadopago model.
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
        $model = new Estadopago();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEstadoPago]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estadopago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEstadoPago]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estadopago model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estadopago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estadopago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estadopago::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
