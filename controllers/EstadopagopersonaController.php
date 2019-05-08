<?php

namespace app\controllers;

use Yii;
use app\models\Estadopagopersona;
use app\models\EstadopagopersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstadopagopersonaController implements the CRUD actions for Estadopagopersona model.
 */
class EstadopagopersonaController extends Controller
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
     * Lists all Estadopagopersona models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstadopagopersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estadopagopersona model.
     * @param integer $idEstadoPago
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEstadoPago, $idPersona)
    {
        return $this->render('view', [
            'model' => $this->findModel($idEstadoPago, $idPersona),
        ]);
    }

    /**
     * Creates a new Estadopagopersona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estadopagopersona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idPersona' => $model->idPersona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estadopagopersona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEstadoPago
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEstadoPago, $idPersona)
    {
        $model = $this->findModel($idEstadoPago, $idPersona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idPersona' => $model->idPersona]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estadopagopersona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEstadoPago
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEstadoPago, $idPersona)
    {
        $this->findModel($idEstadoPago, $idPersona)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estadopagopersona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idEstadoPago
     * @param integer $idPersona
     * @return Estadopagopersona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idEstadoPago, $idPersona)
    {
        if (($model = Estadopagopersona::findOne(['idEstadoPago' => $idEstadoPago, 'idPersona' => $idPersona])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
