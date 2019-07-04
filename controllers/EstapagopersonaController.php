<?php

namespace app\controllers;

use Yii;
use app\models\Estapagopersona;
use app\models\EstapagopersonaSearch;
use app\models\Permiso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstapagopersonaController implements the CRUD actions for Estapagopersona model.
 */
class EstapagopersonaController extends Controller
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
     * Lists all Estapagopersona models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new EstapagopersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estapagopersona model.
     * @param integer $idEstadoPago
     * @param integer $idPago
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEstadoPago, $idPago)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        return $this->render('view', [
            'model' => $this->findModel($idEstadoPago, $idPago),
        ]);
    }

    /**
     * Creates a new Estapagopersona model.
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
        $model = new Estapagopersona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idPago' => $model->idPago]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estapagopersona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEstadoPago
     * @param integer $idPago
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEstadoPago, $idPago)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = $this->findModel($idEstadoPago, $idPago);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idPago' => $model->idPago]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estapagopersona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEstadoPago
     * @param integer $idPago
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEstadoPago, $idPago)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $this->findModel($idEstadoPago, $idPago)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estapagopersona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idEstadoPago
     * @param integer $idPago
     * @return Estapagopersona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idEstadoPago, $idPago)
    {
        if (($model = Estapagopersona::findOne(['idEstadoPago' => $idEstadoPago, 'idPago' => $idPago])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
