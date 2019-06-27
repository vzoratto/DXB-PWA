<?php

namespace app\controllers;

use Yii;
use app\models\Controlpago;
use app\models\ControlpagoSearch;
use app\models\Permiso;
use app\models\Usuario;
use yii\web\IdentityInterface;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ControlpagoController implements the CRUD actions for Controlpago model.
 */
class ControlpagoController extends Controller
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
     * Lists all Controlpago models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new ControlpagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Controlpago model.
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
     * Creates a new Controlpago model.
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
        $model = new Controlpago();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idControlpago]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Controlpago model.
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

        if ($model->load(Yii::$app->request->post())){
           $usuario= Usuario::findIdentity($_SESSION['__id']);
          $model->idUsuario=$usuario->idUsuario;
         if($model->save()) {
             
            return $this->redirect(['view', 'id' => $model->idControlpago]);
        }
    }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Controlpago model.
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
     * Finds the Controlpago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Controlpago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Controlpago::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
