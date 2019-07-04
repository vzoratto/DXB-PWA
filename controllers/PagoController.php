<?php

namespace app\controllers;

use Yii;
use app\models\Pago;
use app\models\PagoSearch;
use app\models\Usuario;
use app\models\Permiso;
use app\models\Persona;
use app\models\Equipo;
use app\models\Grupo;
use app\models\Tipocarrera;
use app\models\Importeinscripcion;
use app\models\Controlpago;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * PagoController implements the CRUD actions for Pago model.
 */
class PagoController extends Controller
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
     * Lists all Pago models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new PagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pago model.
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
            'model' => $this->findModel($id),]
        );
    }

    /**
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        
        $usuario=Usuario::findIdentity($_SESSION['__id']);
        $persona=Persona::findOne(['idUsuario' => $_SESSION['__id']]);
        if($grupo=Grupo::findOne(['idPersona'=>$persona->idPersona])){
              $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);
              $tipocarrera=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
              $importecarrera=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
            
        }else{
            return $this->goHome();  
        }
       
        $model = new Pago();

        if ($model->load(Yii::$app->request->post())) {
            $model->idPersona=$persona->idPersona;
        
           $model->imagenComprobante = UploadedFile::getInstance($model, 'imagenComprobante');
           $imagen_nombre='persona_'.$model->idPersona.'.'.$model->imagenComprobante->extension;
           $imagen_dir='archivo/pagoinscripcion/'.$imagen_nombre;
           $model->imagenComprobante->saveAs($imagen_dir);
           $model->imagenComprobante=$imagen_dir;
           $model->idEquipo=$equipo->idEquipo;
           $model->idImporte=$importecarrera->idImporte;
           
         // echo "<pre>";print_r($model);echo"</pre>";die();
           if($model->save()){
            $idpago = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
            $pagado=$importecarrera->importe - $model->importePagado;
              if($importecarrera->importe ==$pagado){
                $total=0;
              }elseif($importecarrera->importe > $pagado){
                $total=1;
              }
              //return $this->redirect(['view', 'id' => $model->idPago]);     
            }
            $model1=new Controlpago;
            $model1->idPago=$idpago;
            $model1->idUsuario=$usuario->idUsuario;
            if($model1->save()){
                //enviamos mail
                return $this->redirect(['view', 'id' => $model->idPago]);   
            }else{
                //mandamos error
                echo "<pre>";print_r($model1->errors);echo"</pre>";die();
            }
        }
    
    
        return $this->render('create', [
            'model' => $model,
            'equipo'=> $equipo,//dniCapitan,idEquipo,idTipoCarrera
            'persona'=> $persona,//idPersona
            'usuario'=> $usuario,//idUsuario, dniUsuario,mailUsuario
            'tipocarrera'=>$tipocarrera,//descripcionCarrera
            'importecarrera'=>$importecarrera,//importe del tipo de carrera
        ]);
    }
    /**
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   /* public function actionCreate1()
    {/*
        $usuario=Usuario::findIdentity($_SESSION['__id']);
        $persona=Persona::findOne(['idUsuario' => $_SESSION['__id']]);
        if($grupo=Grupo::findOne(['idPersona'=>$persona->idPersona])){
              $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);
              $tipocarrera=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
              $importecarrera=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
        } */ 
      /*  if(Permiso::requerirRol('administrador')){
                $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
                $this->layout='/main3';
        }
       
        $model = new Pago();

        if ($model->load(Yii::$app->request->post())) {
            $model->idPersona=$persona->idPersona;
        
           $model->imagenComprobante = UploadedFile::getInstance($model, 'imagenComprobante');
           $imagen_nombre='persona_'.$model->idPersona.'.'.$model->imagenComprobante->extension;
           $imagen_dir='archivo/pagoinscripcion/'.$imagen_nombre;
           $model->imagenComprobante->saveAs($imagen_dir);
           $model->imagenComprobante=$imagen_dir;
           $model->idEquipo=$equipo->idEquipo;
           $model->idImporte=$importecarrera->idImporte;
           
         // echo "<pre>";print_r($model);echo"</pre>";die();
           if($model->save()){
            $idpago = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
            $pagado=$importecarrera->importe - $model->importePagado;
              if($importecarrera->importe ==$pagado){
                $total=0;
              }elseif($importecarrera->importe > $pagado){
                $total=1;
              }
              //return $this->redirect(['view', 'id' => $model->idPago]);     
            }
            $model1=new Controlpago;
            $model1->idPago=$idpago;
            $model1->idUsuario=$usuario->idUsuario;
            if($model1->save()){
                //enviamos mail
                return $this->redirect(['view', 'id' => $model->idPago]);   
            }else{
                //mandamos error
                echo "<pre>";print_r($model1->errors);echo"</pre>";die();
            }
        }
    
    
        return $this->render('create', [
            'model' => $model,
            'equipo'=> $equipo,//dniCapitan,idEquipo,idTipoCarrera
            'persona'=> $persona,//idPersona
            'usuario'=> $usuario,//idUsuario, dniUsuario,mailUsuario
            'tipocarrera'=>$tipocarrera,//descripcionCarrera
            'importecarrera'=>$importecarrera,//importe del tipo de carrera
        ]);
}*/


    /**
     * Updates an existing Pago model.
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
            return $this->redirect(['view', 'id' => $model->idPago]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pago model.
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
     * Finds the Pago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pago::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
