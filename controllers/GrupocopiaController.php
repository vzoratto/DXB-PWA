<?php

namespace app\controllers;

use Yii;
use app\models\Grupocopia;
use app\models\GrupocopiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GrupocopiaController implements the CRUD actions for Grupocopia model.
 */
class GrupocopiaController extends Controller
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
     * Lists all Grupocopia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrupocopiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupocopia model.
     * @param integer $idEquipo
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEquipo, $idPersona)
    {
        return $this->render('view', [
            'model' => $this->findModel($idEquipo, $idPersona),
        ]);
    }

    /**
     * Creates a new Grupocopia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grupocopia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEquipo' => $model->idEquipo, 'idPersona' => $model->idPersona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Grupocopia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEquipo
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEquipo, $idPersona)
    {
        $model = $this->findModel($idEquipo, $idPersona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEquipo' => $model->idEquipo, 'idPersona' => $model->idPersona]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Grupocopia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEquipo
     * @param integer $idPersona
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEquipo, $idPersona)
    {
        $this->findModel($idEquipo, $idPersona)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Grupocopia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idEquipo
     * @param integer $idPersona
     * @return Grupocopia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idEquipo, $idPersona)
    {
        if (($model = Grupocopia::findOne(['idEquipo' => $idEquipo, 'idPersona' => $idPersona])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
