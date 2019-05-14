<?php

namespace app\controllers;

use Yii;
use app\models\Localidad;
use app\models\LocalidadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LocalidadController implements the CRUD actions for Localidad model.
 */
class LocalidadController extends Controller
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
     * Lists all Localidad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LocalidadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Localidad model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Localidad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Localidad();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idLocalidad]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Localidad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idLocalidad]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Localidad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Localidad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Localidad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Localidad::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionLocalidades() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idProvincia = $parents[0];

                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                //$out = [
                //    ['id'=>'1', 'name'=>$idProvincia],
                //    ['id'=>'2', 'name'=>'<sub-cat-name2>']
                //];
                $locali = new \app\models\Localidad();
                $out = $locali::getLocalidades($idProvincia); 
            
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}
