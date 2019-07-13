<?php

namespace app\controllers;

use Yii;
use app\models\Equipo;
use app\models\EquipoSearch;
use app\models\Carrerapersona;
use app\models\Usuario;
use app\models\Persona;
use app\models\Grupo;
use app\models\CambiaCapitanForm;
use app\models\Permiso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EquipoController implements the CRUD actions for Equipo model.
 */
class EquipoController extends Controller
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
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='/main3';
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipo model.
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
     * Creates a new Equipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Equipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEquipo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idEquipo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCambiacap()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
       // $model = $this->findModel($id);
       $model=new CambiaCapitanForm;
      
        if ($model->load(Yii::$app->request->post())){ 
           // echo '<pre>';print_r(Yii::$app->request->post());echo '</pre>';die();
                $equipo=Equipo::findOne(['dniCapitan'=>$model->dniCapitan]);
                //echo '<pre>';print_r($equipo);echo '</pre>';die();
                $usuario=Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
                $usuario1=Usuario::findOne(['dniUsuario'=>$model->dniUsuario]);
               // echo '<pre>';print_r($usuario);echo '</pre>';die();
               
               // echo '<pre>';print_r($usuario1);echo '</pre>';die();
                $persona=Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
                $persona1=Persona::findOne(['idUsuario'=>$usuario1->idUsuario]);
                $equipo->dniCapitan=$model->dniUsuario;
              if($equipo->save()){
                  $grupo=Grupo::findOne(['idPersona'=>$persona->idPersona]);
                  $grupo->idPersona=$persona1->idPersona;
                  if($grupo->save()){
                      $carreraper=Carrerapersona::findOne(['idPersona'=>$persona->idPersona]);
                      $carreraper->idPersona=$persona1->idPersona;
                      if($carreraper->save()){
                
                        $this->Yii::$app->session->setFlash('cambiaFormSubmitted');
                        return $this->refresh();
                      }
                  }
               }
            //}else{
               // $this->Yii::$app->session->setFlash('nocambiaFormSubmitted');
               //         return $this->refresh();
           // }
           // return $this->redirect(['view', 'id' => $model->idEquipo]);
        }
    
        return $this->render('cambia', [
            'model' => $model,
            
        ]);
    }

    /**
     * Deletes an existing Equipo model.
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
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
