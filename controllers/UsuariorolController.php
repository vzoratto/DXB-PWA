<?php

namespace app\controllers;

use Yii;
use app\models\Usuariorol;
use app\models\UsuariorolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariorolController implements the CRUD actions for Usuariorol model.
 */
class UsuariorolController extends Controller
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
     * Lists all Usuariorol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariorolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuariorol model.
     * @param integer $idRol
     * @param integer $idUsuario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idRol, $idUsuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($idRol, $idUsuario),
        ]);
    }

    /**
     * Creates a new Usuariorol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuariorol();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idRol' => $model->idRol, 'idUsuario' => $model->idUsuario]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Usuariorol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRol
     * @param integer $idUsuario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idRol, $idUsuario)
    {
        $model = $this->findModel($idRol, $idUsuario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idRol' => $model->idRol, 'idUsuario' => $model->idUsuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuariorol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idRol
     * @param integer $idUsuario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idRol, $idUsuario)
    {
        $this->findModel($idRol, $idUsuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuariorol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idRol
     * @param integer $idUsuario
     * @return Usuariorol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idRol, $idUsuario)
    {
        if (($model = Usuariorol::findOne(['idRol' => $idRol, 'idUsuario' => $idUsuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
