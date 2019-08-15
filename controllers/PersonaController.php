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
use app\models\Equipo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Respuesta;
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
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
     * Displays a single Persona model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView1($id)
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
       $transaction = Yii::$app->getDb()->beginTransaction(); // Iniciamos una transaccion
       
       try {
          $persona=$this->findModel($id);
          $usuario=Usuario::find()->where(['idUsuario'=>$persona->idUsuario])->one();
          //se borra la asociacion al equipo
          Grupo::findOne(['idPersona'=>$id])->delete();
          //si es capitan borro el equipo
          if($persona->soyCapitan()){
              Equipo::findOne(['dniCapitan'=>$persona->usuario->dniUsuario])->delete();
          }

          //se elimina el registro de tablaPersona
          Carrerapersona::findOne(['idPersona'=>$id])->delete();

          //se elimina la respuestas a la encuesta
          Respuesta::deleteAll(['idPersona'=>$persona->idPersona]);
          //se elimina el registro persona para que deje eliminar a fichaMedica,personadirrecion,personaemergencia
          $persona->delete();
          //se elimina de la tabla fichaMedica el registro que habia generado el corredor
          Fichamedica::findOne(['idFichaMedica'=>$persona->idFichaMedica])->delete();
           //se elimina de la tabla PersonaDireccion el registro que habia generado el corredor
           Personadireccion::findOne(['idPersonaDireccion'=>$persona->idPersonaDireccion])->delete();
           //se elimina de la tabla PersonaEmergencia el registro que habia generado el corredor
           Personaemergencia::findOne(['idPersonaEmergencia'=>$persona->idPersonaEmergencia])->delete();
           //se elimina el usuario
           $usu=Usuario::findOne(['idUsuario'=>$persona->idUsuario])->delete();
           $eliminacionTablas=false;
           if($usu==1){
               $eliminacionTablas=true;
           }else{
               $eliminacionTablas=false;
           }
          if($eliminacionTablas){
              $transaction->commit();
              $mensaje="hubo un problema al eliminar este regitro";
          }else{
               $transaction->rollBack();
              $mensaje="Se ha eliminado el registro sin problemas.";
          }


           //Usuario::deleteAll($persona->idUsuario);

           return Yii::$app->response->redirect(['site/admin'])->send();
        
       } catch(\Exception $e) {
          $transaction->rollBack();
          throw $e;
       }
    }
/**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete1($id)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }
       // $this->findModel($id)->delete();
       $mensaje='';
       $borrado=false; //Asignamos false a la variable borrado
       $transaction = Yii::$app->getDb()->beginTransaction(); // Iniciamos una transaccion
       
       try {
          $persona=$this->findModel($id);
          $usuario=Usuario::find()->where(['idUsuario'=>$persona->idUsuario])->one();
          $grupo=Grupo::find()->where(['idPersona'=>$id])->One();
          $carrera=Carrerapersona::find()->where(['idPersona'=>$id])->One();
          $respuestas=Respuesta::find()->where(['idPersona'=>$id])->all();
         // echo '<pre>';print_r($carrera);print_r($usuario);print_r($persona);print_r($grupo);print_r($respuestas);echo '</pre>';die();
          foreach($respuestas as $respuesta){
              Respuesta::deleteAll($respuesta->idRespuesta);
          }
          Grupo::deleteAll($grupo->idPersona);
          Carrerapersona::deleteAll(['idPersona' => $id]);
          Persona::deleteAll($id);
          Personadireccion::deleteAll($persona->idPersonaDireccion);
          Fichamedica::deleteAll($persona->idFichaMedica);
          Personaemergencia::deleteAll($persona->idPersonaEmergencia);
          if($equipod=Equipo::find()->where(['dniCapitan'=>$usuario->dniUsuario])->One()){
             $eq=Equipo::deleteAll(['idEquipo'=>$equipod->idEquipo]);
          }
         
          $transaction->commit();
            $borrado=true;
            if(!$borrado){
                $mensaje="hubo un problema al eliminar este regitro";
             }else{
                $mensaje="Se ha eliminado el registro sin problemas.";
             }
               return $this->render('view1',[
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
