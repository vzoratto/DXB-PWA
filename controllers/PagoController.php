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
use app\models\Estadopagoequipo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\arrayDataProvider;
use yii\db\Query; 
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
        if(Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
            return $this->goHome();
        }
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
     * Lists all Pago models.
     * @return mixed
     */
    public function actionIndex1()
    {
        if(Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new PagoSearch();
        $dataProvider = $searchModel->check();
        //echo '<pre>';var_dump($dataProvider);echo '</pre>';die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Pago models.
     * @return mixed
     */
    public function actionIndex2()
    {
        if(Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new PagoSearch();
        $dataProvider = $searchModel->nocheck();
        //echo '<pre>';var_dump($dataProvider);echo '</pre>';die();
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
        $model= $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'controlpago'=>Controlpago::findOne(['idPago'=>$model->idPago]),
        ]);
    }
    /**
     * Vista para elusuario una vez ingresado el pago.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView1($id)
    {
        return $this->render('view1', [
            'model' => $this->findModel($id),]//vista para el usuario corredor
        );
    }

   
/**
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate2()//para crear pagos por importe inscripcion por equipo
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if($usuario=Usuario::findOne(['idUsuario'=>$_SESSION['__id']])){
            if(!$equipo=Equipo::findOne(['dniCapitan'=>$usuario->dniUsuario])){
                    return $this->goHome();
                }else{
                  $persona=Persona::findOne(['idUsuario'=>$_SESSION['__id']]);
                  if(Pago::findOne(['idPersona'=>$persona->idPersona])){
                    $pagos=Pago::sumaTotalEquipo($equipo->idEquipo);
                    $tipocar=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                    $importecar=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                        if($importecar->importe==$pagos){
                          return $this->goHome();
                      }
                  }
                }
            
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $saldo='';$mensaje='';
        $suma=0;$pagado=0;
        //obtenemos todos los modelos necearios para registrar el pago
        $usuario=Usuario::findIdentity($_SESSION['__id']);
        $persona=Persona::findOne(['idUsuario' => $_SESSION['__id']]);
        if($grupo=Grupo::findOne(['idPersona'=>$persona->idPersona])){
              $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);
              $suma=Pago::sumaTotalEquipo($grupo->idEquipo);
              $tipocarrera=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
              $importecarrera=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
              $saldo=$importecarrera->importe - $suma;//saldo de lo pagado para control form
            }else{
            return $this->goHome();  
        }
       
        $guardado=false; //Asignamos false a la variable guardado
        $transaction = Pago::getDb()->beginTransaction(); // Iniciamos una transaccion
        try {
        $model = new Pago();
        if ($model->load(Yii::$app->request->post())) {
            $pagado=$suma + $model->importePagado;
           // echo '<pre>';echo $pagado;echo '</pre>';die();
           if($importecarrera->importe >= $pagado){
              $model->idPersona=$persona->idPersona;
             //preparamos el modelo para guarar la imagen del ticket
              $model->imagenComprobante = UploadedFile::getInstance($model, 'imagenComprobante');
               $imagen_nombre=rand(0,4000).'pers_'.$model->idPersona.'.'.$model->imagenComprobante->extension;
             $imagen_dir='archivo/pagoinscripcion/'.$imagen_nombre;
              $model->imagenComprobante->saveAs($imagen_dir);
              $model->imagenComprobante=$imagen_dir;
              $model->idEquipo=$equipo->idEquipo;
              $model->idImporte=$importecarrera->idImporte;   
                if($model->save()){
                   $idpago = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
            
                   $model1=new Controlpago;
                   $model1->idPago=$idpago;
                   $model1->chequeado=0;
                   $model1->idGestor=1;
                   $model1->save();

              }//fin carga tabla pago
           }else{
               $mensaje="El pago que ibas a efectuar es superior al costo de la inscripción. ";
               return $this->render('aviso',[
                   'persona' => $persona,
                   'importecarrera'=>$importecarrera,
                   'usuario'=>$usuario,
                   'suma'=>$suma,
                   'mensaje'=>$mensaje,
                ]);
           }  
                  $transaction->commit();
                  $guardado=true;
                  if ($guardado){ 
                    if($importecarrera->importe == $model->importePagado){
                       $total='pago total';//pago total
                       Yii::$app->session->setFlash('pagoTotal');//enviamos mensaje
                       return $this->redirect(['view1', 'id' => $idpago]);
               
                    }elseif($importecarrera->importe > $model->importePagado){
                        $total='pago parcial';//pago parcial
                        Yii::$app->session->setFlash('pagoParcial');//enviamos mensaje
                        return $this->redirect(['view1', 'id' => $idpago]);
              
                    }   
                }//fin guardado true
            }else{//fin verificarion de datos
                return $this->render('create', [
                  'model' => $model,
                  'equipo'=> $equipo,//dniCapitan,idEquipo,idTipoCarrera
                  'persona'=> $persona,//idPersona
                  'usuario'=> $usuario,//idUsuario, dniUsuario,mailUsuario
                  'tipocarrera'=>$tipocarrera,//descripcionCarrera
                  'importecarrera'=>$importecarrera,//importe del tipo de carrera
                  'saldo'=>$saldo,//saldo de lo pagado
                 ]);
           }
        } catch(\Exception $e) {//atrapa el error
            $guardado=false;

            $transaction->rollBack();
            throw $e;
          }
        }
    /**
     * Crea pagos desde la pagina de gestores.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate1()//para crear pagos por el gestor
    {
        if(Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
                $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
                $this->layout='/main3';
        }
       
        $model = new Pago();

        if ($model->load(Yii::$app->request->post())) {
           
           $usuario=Usuario::findOne(['idUsuario'=>$model->dniUsu]);
           $persona=Persona::findOne(['idUsuario' =>$usuario->idUsuario]);
            if($grupo=Grupo::findOne(['idPersona'=>$persona->idPersona])){
                $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);
                $tipocarrera=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                $importecarrera=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                $costo=$importecarrera->importe * $equipo->cantidadPersonas;
            } 
            $model->idPersona=$persona->idPersona;
           
           $model->imagenComprobante = UploadedFile::getInstance($model, 'imagenComprobante');
           $imagen_nombre=rand(0,4000).'pers_'.$model->idPersona.'.'.$model->imagenComprobante->extension;
           $imagen_dir='archivo/pagoinscripcion/'.$imagen_nombre;
           $model->imagenComprobante->saveAs($imagen_dir);
           $model->imagenComprobante=$imagen_dir;
           $model->idEquipo=$equipo->idEquipo;
           $model->idImporte=$importecarrera->idImporte;

           if($model->save()){
            $idpago = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
            $model1=new Controlpago;
            $model1->idPago=$idpago;
            $model1->chequeado=0;
            $model1->idGestor=1;
            if($model1->save()){
               
              if($costo == $model->importePagado){
                $total='pago total';//pago total
                Yii::$app->session->setFlash('pagoTotal');//enviamos mensaje
                return $this->redirect(['view1', 'id' => $idpago]);
              
              }elseif($costo > $model->importePagado){
                $total='pago parcial';//pago parcial
                Yii::$app->session->setFlash('pagoParcial');//enviamos mensaje
                return $this->redirect(['view', 'id' => $idpago]);
               
              }   
            }else{
                //mandamos error
                $error=$model1->errors;
            }
          }
        }
        $lista=Usuario::getLosUsuarios();
       // echo '<pre>';print_r($lista);echo '</pre>';die();
        $usuario=new Usuario();
        $equipo=new Equipo();
        $persona=new Persona();
        return $this->render('create1', [
            'model' => $model,
            'lista'=>$lista,
           'usuario'=>$usuario,
            'equipo'=>$equipo,
            'persona'=>$persona,
        ]);
  }
   /**
     * Creates a new Pago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()//para crear pagos por importe inscripcion por persona
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if($usuario=Usuario::findOne(['idUsuario'=>$_SESSION['__id']])){
            if(!$equipo=Equipo::findOne(['dniCapitan'=>$usuario->dniUsuario])){
                    return $this->goHome();
            }else{
                  $persona=Persona::findOne(['idUsuario'=>$_SESSION['__id']]);
                  if(Pago::findOne(['idPersona'=>$persona->idPersona])){
                    $pagos=Pago::sumaTotalEquipo($equipo->idEquipo);
                    $tipocar=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                    $importecar=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                    $costo=$importecar->importe * $equipo->cantidadPersonas;
                        if($costo==$pagos){
                          return $this->goHome();
                      }
                  }
             }
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $saldo='';$mensaje='';
        $suma=0;$pagado=0;
        //obtenemos todos los modelos necearios para registrar el pago
        $usuario=Usuario::findIdentity($_SESSION['__id']);
        $persona=Persona::findOne(['idUsuario' => $_SESSION['__id']]);
        if($grupo=Grupo::findOne(['idPersona'=>$persona->idPersona])){
              $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);
              $suma=Pago::sumaTotalEquipo($grupo->idEquipo);
              $tipocarrera=TipoCarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
              $importecarrera=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
              $importe=$importecarrera->importe * $equipo->cantidadPersonas;//importe individual por cantidad de personas del equipo
              $saldo=$importe - $suma;//saldo de lo pagado para control form
         }else{
            return $this->goHome();  
        }
        $guardado=false; //Asignamos false a la variable guardado
        $transaction = Pago::getDb()->beginTransaction(); // Iniciamos una transaccion
        try {
        $model = new Pago();
          if ($model->load(Yii::$app->request->post())) {
            
              $model->importePagado=0;
              $model->idPersona=$persona->idPersona;
             //preparamos el modelo para guarar la imagen del ticket
              $model->imagenComprobante = UploadedFile::getInstance($model, 'imagenComprobante');
               $imagen_nombre=rand(0,4000).'pers_'.$model->idPersona.'.'.$model->imagenComprobante->extension;
             $imagen_dir='archivo/pagoinscripcion/'.$imagen_nombre;
              $model->imagenComprobante->saveAs($imagen_dir);
              $model->imagenComprobante=$imagen_dir;
              $model->idEquipo=$equipo->idEquipo;
              $model->idImporte=$importecarrera->idImporte;   
                if($model->save()){
                   $idpago = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
            
                   $model1=new Controlpago;
                   $model1->idPago=$idpago;
                   $model1->chequeado=0;
                   $model1->idGestor=1;
                   $model1->save();
             }//fin carga tabla pago
           
                  $transaction->commit();
                  $guardado=true;
                  if ($guardado){ 
                    
                       Yii::$app->session->setFlash('pago');//enviamos mensaje
                       return $this->redirect(['view1', 'id' => $idpago]);
                    
                  }//fin guardado true
            }else{//fin verificarion de datos
                $check=1;
                if($pagos=Pago::findAll(['idEquipo'=>$equipo->idEquipo])){
                   foreach($pagos as $pago){
                      if($control=Controlpago::findOne(['idPago'=>$pago->idPago,'chequeado'=>0])){
                          $check=$control->chequeado;
                      }
                   }  //control boton form pago para pagos no chequeados
                }    //de este forma se controla la carga de imagenes superfluas
              
                return $this->render('create', [
                  'model' => $model,
                  'equipo'=> $equipo,//dniCapitan,idEquipo,idTipoCarrera
                  'persona'=> $persona,//idPersona
                  'usuario'=> $usuario,//idUsuario, dniUsuario,mailUsuario
                  'tipocarrera'=>$tipocarrera,//descripcionCarrera
                  'importe'=>$importe,//importe del tipo de carrera
                  //'importecarrera'=>$importecarrera,//importe del tipo de carrera
                  'saldo'=>$saldo,//saldo de lo pagado
                  'check'=>$check,
                 ]);
           }
        } catch(\Exception $e) {//atrapa el error
            $transaction->rollBack();
            throw $e;
          }
        }

    /**
     * Updates an existing Pago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
            return $this->goHome();
        }
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
        if(Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
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

    public function actionNombrecorredor(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $dniUsu = $parents[0]; //Obtenemos el ID del equipo
 
                // A través del DNI usuario, buscamos su objeto Usuario
                $objUsuario = Usuario::find()->where(['idUsuario'=>$dniUsu])->one();
                $idUsu = $objUsuario['idUsuario']; //Obtenemos el ID del usuario
                // Con el ID del usuario, obtenemos el objeto Persona, para así obtener su nombre y apellido 
                $objPersona = Persona::find()->where(['idUsuario'=>$idUsu])->one();
                $nombrePersona = $objPersona['nombrePersona'];
                $apellidoPersona = $objPersona['apellidoPersona'];
                $nombreCompleto = $nombrePersona . " " . $apellidoPersona; // Concatenamos su nombre y apellido

                $out = [
                    ['id' => $idUsu, 'name' => $nombreCompleto]
                ];
            
                return ['output'=>$out, 'selected'=>$idUsu];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionDnicapitan(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $dniUsu = $parents[0]; //Obtenemos el ID del equipo
 
                // A través del DNI usuario, buscamos su objeto Usuario
                $objUsuario = Usuario::find()->where(['idUsuario'=>$dniUsu])->one();
                $idUsu = $objUsuario['idUsuario']; //Obtenemos el ID del usuario
                 // Con el ID del usuario, obtenemos el objeto Persona, para así obtener su nombre y apellido 
                 $objPersona = Persona::find()->where(['idUsuario'=>$idUsu])->one();

               // A través del DNI usuario, buscamos su objeto grupo
               $objGrupo = Grupo::find()->where(['idPersona'=>$objPersona->idPersona])->one();
               $idEquipo = $objGrupo['idEquipo']; //Obtenemos el ID del grupo
                // A través del DNI usuario, buscamos su objeto equipo
                $objEquipo = Equipo::find()->where(['idEquipo'=>$idEquipo])->one();
                $dniCap = $objEquipo['dniCapitan']; //Obtenemos el dni del equipo
                
                $out = [
                    ['id' => $idUsu, 'name' => $dniCap]
                ];
            
                return ['output'=>$out, 'selected'=>$idUsu];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionNombrecapitan(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $dniUsu = $parents[0]; //Obtenemos el ID del equipo
 
                // A través del DNI usuario, buscamos su objeto Usuario
                $objUsuario = Usuario::find()->where(['idUsuario'=>$dniUsu])->one();
                $idUsu = $objUsuario['idUsuario']; //Obtenemos el ID del usuario
                 // Con el ID del usuario, obtenemos el objeto Persona, para así obtener su nombre y apellido 
                 $objPersona = Persona::find()->where(['idUsuario'=>$idUsu])->one();

               // A través del DNI usuario, buscamos su objeto grupo
               $objGrupo = Grupo::find()->where(['idPersona'=>$objPersona->idPersona])->one();
               $idEquipo = $objGrupo['idEquipo']; //Obtenemos el ID del grupo
                // A través del DNI usuario, buscamos su objeto equipo
                $objEquipo = Equipo::find()->where(['idEquipo'=>$idEquipo])->one();
                $dniCap = $objEquipo['dniCapitan']; //Obtenemos el dni del equipo
                 // A través del DNI usuario, buscamos su objeto Usuario capitan
                 $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniCap])->one();
                 $idUsuper = $objUsuario['idUsuario']; //Obtenemos el ID del usuario
                // Con el ID del usuario, obtenemos el objeto Persona, para así obtener su nombre y apellido 
                $objPersona = Persona::find()->where(['idUsuario'=>$idUsuper])->one();
                $nombrePersona = $objPersona['nombrePersona'];
                $apellidoPersona = $objPersona['apellidoPersona'];
                $nombreCompleto = $nombrePersona . " " . $apellidoPersona; // Concatenamos su nombre y apellido

                $out = [
                    ['id' => $idUsu, 'name' => $nombreCompleto]
                ];
             
                return ['output'=>$out, 'selected'=>$idUsu];
            }
        }
       return ['output'=>'', 'selected'=>''];
    }
}
