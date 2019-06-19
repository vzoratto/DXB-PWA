<?php

namespace app\controllers;

use Yii;
use app\models\Pagoinscripcion;
use app\models\PagoinscripcionSearch;
use app\models\Usuario;
use app\models\Persona;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PagoinscripcionController implements the CRUD actions for Pagoinscripcion model.
 */
class PagoinscripcionController extends Controller
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
     * Lists all Pagoinscripcion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PagoinscripcionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pagoinscripcion model.
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
     * Creates a new Pagoinscripcion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Pagoinscripcion();
        //$usu=Yii::$app->user->identity->dniUsuario;
        $persona=Pagoinscripcion::getUsupersona();
        //echo "<pre>";print_r($persona);echo $usu;echo"</pre>";
        if ($model->load(Yii::$app->request->post())) {
            $model->idPersona=$persona->idPersona;
            $model->pagado=1;
            $model->imagencomprobante = UploadedFile::getInstance($model, 'imagencomprobante');
            $imagen_nombre='persona_'.$model->idPersona.'.'.$model->imagencomprobante->extension;
            $imagen_dir='archivo/pagoinscripcion/'.$imagen_nombre;
            $model->imagencomprobante->saveAs($imagen_dir);
            $model->imagencomprobante=$imagen_dir;
              if($model->save()){
                    return $this->redirect(['view', 'id' => $model->idPago]);
               }   
      }
        return $this->render('create', [
            'model' => $model,
            
        ]);
    }
    
    /**
     * Updates an existing Pagoinscripcion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPago]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pagoinscripcion model.
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
     * Finds the Pagoinscripcion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pagoinscripcion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pagoinscripcion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
