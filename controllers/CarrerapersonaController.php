<?php

namespace app\controllers;

use Yii;
use app\models\Carrerapersona;
use app\models\Carrerapersonasearch;
use app\models\Persona;
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
        $searchModel = new Carrerapersonasearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $persona = new \app\models\Persona();
		
        return $this->render('index', [
            'searchModel' => $searchModel,
			'dataProvider'=> $dataProvider,
            'persona' => $persona
			
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
        $model = $this->findModel($idTipoCarrera, $idPersona);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionUpdatepersona($idTipoCarrera, $idPersona)
    {
        $model = $this->findModel($idTipoCarrera, $idPersona);

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
	
	
	public function actionTabsData() {
          $html = $this->renderPartial('tabContent');
    return Json::encode($html);
}
}
