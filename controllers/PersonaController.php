<?php

namespace app\controllers;

use Yii;
use app\models\Persona;
use app\models\PersonaSearch;
use app\models\Permiso;
use app\models\Grupo;
use app\models\Usuario;
use app\models\Personadireccion;
use app\models\Fichamedica;
use app\models\Personaemergencia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Carrerapersona;
use app\models\Carrerapersonasearch;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class PersonaController extends Controller
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
     * Lists all Persona models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }
        $mensaje='';
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mensaje'=>$mensaje,
        ]);
    }

    /**
     * Displays a single Persona model.
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
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = '/main2';
        $model = new Persona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPersona]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Persona model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['carrerapersona/index', 'id' => $model->idPersona]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }
       // $this->findModel($id)->delete();
       $mensaje='';
       $borrado=false; //Asignamos false a la variable borrado
       $transaction = Grupo::getDb()->beginTransaction(); // Iniciamos una transaccion
       
       try {
       $persona=$this->findModel($id);
       $grupo=Grupo::find()->where(['idPersona'=>$id])->One();
       $equipo=$grupo->idEquipo;$per=$grupo->idPersona;
       $carrera=Carrerapersona::find()->where(['idPersona'=>$id])->One();
       $tipocarrera=$carrera->idTipoCarrera;
       //echo '<pre>';print_r($grupo);echo $equipo.' '.$per;echo '</pre>';die();
       Grupo::findOne($equipo,$per)->delete();
       Carrerapersona::findOne($tipocarrera,$id)->delete();
       Persona::findOne($id)->delete();
       Usuario::findOne($persona->idUsuario)->delete();
       Personadireccion::findOne($persona->idPersonaDireccion)->delete();
       Fichamedica::findOne($persona->idFichaMedica)->delete();
       Personaemergencia::findOne($persona->idPersonaEmergencia)->delete();
       
       $transaction->commit();
            $borrado=true;
            if(!$borrado){
                $mensaje="hubo un problema al eliminar este regitro";
             }else{
                $mensaje="Se ha eliminado el registro sin problemas.";
             }
               return $this->render('persona/view1',[
                   'mensaje'=>$mensaje,
                   'persona'=>$persona,
                   ]);
        
      } catch(\Exception $e) {
          $transaction->rollBack();
          throw $e;
      }
    }

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
