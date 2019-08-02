<?php

namespace app\controllers;

use Yii;
use app\models\Carrerapersonacopia;
use app\models\CarrerapersonacopiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarrerapersonacopiaController implements the CRUD actions for Carrerapersonacopia model.
 */
class CarrerapersonacopiaController extends Controller
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
     * Lists all Carrerapersonacopia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarrerapersonacopiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carrerapersonacopia model.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idTipoCarrera, $idPersona)
    {
        return $this->render('view', [
            'model' => $this->findModel($idTipoCarrera, $idPersona),
        ]);
    }

    /**
     * Creates a new Carrerapersonacopia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Carrerapersonacopia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Carrerapersonacopia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idTipoCarrera, $idPersona)
    {
        $model = $this->findModel($idTipoCarrera, $idPersona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Carrerapersonacopia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idTipoCarrera, $idPersona)
    {
        $this->findModel($idTipoCarrera, $idPersona)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Carrerapersonacopia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idTipoCarrera
     * @param integer $idPersona
     * @return Carrerapersonacopia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idTipoCarrera, $idPersona)
    {
        if (($model = Carrerapersonacopia::findOne(['idTipoCarrera' => $idTipoCarrera, 'idPersona' => $idPersona])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
