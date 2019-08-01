<?php

namespace app\controllers;

use Yii;
use app\models\Estadopagoequipo;
use app\models\EstadopagoequipoSearch;
use app\models\EquipoSearch;
use app\models\Permiso;
use app\models\Equipo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//estado del equipo

/**
 * EstadopagoequipoController implements the CRUD actions for Estadopagoequipo model.
 */
class EstadopagoequipoController extends Controller
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
     * Lists all Estadopagoequipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new EstadopagoequipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
/**
     * Lists all Estadopagoequipo models.
     * @return mixed
     */
    public function actionIndex1()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->leftJoin('estadopagoequipo','equipo.idEquipo=estadopagoequipo.idEquipo')->andWhere(['equipo.deshabilitado' =>0])->andWhere(['estadopagoequipo.idEquipo' => null]);//Poner condicion al dataprovider para que traiga solo el id solicitado
        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Estadopagoequipo model.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idEstadoPago, $idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        return $this->render('view', [
            'model' => $this->findModel($idEstadoPago, $idEquipo),
        ]);
    }

    /**
     * Creates a new Estadopagoequipo model.
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
        $model = new Estadopagoequipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idEquipo' => $model->idEquipo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Estadopagoequipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idEstadoPago, $idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = $this->findModel($idEstadoPago, $idEquipo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idEquipo' => $model->idEquipo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estadopagoequipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEstadoPago, $idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }
        $this->findModel($idEstadoPago, $idEquipo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estadopagoequipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return Estadopagoequipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idEstadoPago, $idEquipo)
    {
        if (($model = Estadopagoequipo::findOne(['idEstadoPago' => $idEstadoPago, 'idEquipo' => $idEquipo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
