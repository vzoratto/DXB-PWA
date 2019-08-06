<?php

namespace app\controllers;

use Yii;
use app\models\Estadopagoequipo;
use app\models\EstadopagoequipoSearch;
use app\models\EquipoSearch;
use app\models\Permiso;
use app\models\Equipo;
use app\models\Fechacarrera;
use app\models\Grupo;
use app\models\Tipocarrera;
use app\models\Usuario;
use app\models\Importeinscripcion;
use app\models\Persona;
use app\models\Pago;
use app\models\Carrerapersonacopia;
use app\models\Carrerapersona;
use app\models\Grupocopia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
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
        }else{
            return $this->goHome();
        }
        $fechas=Fechacarrera::find()->all();
        $searchModel = new EstadopagoequipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'fechas'=>$fechas,
        ]);
    }
/**
     * Lists all Estadopagoequipo models.
     * @return mixed
     */
    public function actionIndex1()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }else{
            return $this->goHome();
        }
        $fechas=Fechacarrera::find()->all();
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->leftJoin('estadopagoequipo','equipo.idEquipo=estadopagoequipo.idEquipo')->andWhere(['equipo.deshabilitado' =>0])->andWhere(['estadopagoequipo.idEquipo' => null]);//Poner condicion al dataprovider para que traiga solo el id solicitado
        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'fechas'=>$fechas,
        ]);
    }

    /**
     * Lists all Estadopagoequipo models.
     * @return mixed
     */
    public function actionIndex2()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }else{
            return $this->goHome();
        }
        $fechas=Fechacarrera::find()->all();
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->leftJoin('estadopagoequipo','equipo.idEquipo=estadopagoequipo.idEquipo')->andWhere(['equipo.deshabilitado' =>1])->andWhere(['estadopagoequipo.idEquipo' => null]);//Poner condicion al dataprovider para que traiga solo el id solicitado
        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'fechas'=>$fechas,
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
     * Displays a single Estadopagoequipo model.
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView1($idEstadoPago="",$idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = Equipo::findOne(['idEquipo' => $idEquipo]);
        return $this->render('view1', [
            'model' => $model
        ]);
    }
/**
     * Displays a single Estadopagoequipo model.
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView2($idEstadoPago="",$idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $model = Equipo::findOne(['idEquipo' => $idEquipo]);
        return $this->render('view2', [
            'model' => $model
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
        }else{
            return $this->goHome();
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
        }else{
            return $this->goHome();
        }
        $model = $this->findModel($idEstadoPago, $idEquipo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idEstadoPago' => $model->idEstadoPago, 'idEquipo' => $model->idEquipo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionEnviamail(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $mensaje='';
        if (Yii::$app->request->get()) {
          $idEstadoPago = Html::encode($_GET["id1"]);
          $idEquipo = Html::encode($_GET["id"]);
          $equipo=Equipo::findOne(['idEquipo'=>$idEquipo]);

          if($user=Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan])){//verificamos que exista el usuario
             $persona=Persona::findOne(['idUsuario'=>$user->idUsuario]);
            $dni = urlencode($user->dniUsuario);
            $mailUsuario = $user->mailUsuario;
            $nombre=$persona->nombrePersona." ".$persona->apellidoPersona;
           // echo '<pre>';echo $nombre;echo'</pre>';die();
            $subject = "Pago de la inscripción";// Asunto del mail
            //$host=Yii::$app->request->hostInfo;
            $body = "
                <div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                        <div class='col-lg-12 col-xs-6' style='position:relative; margin: auto; max-width: 500px; background:white; padding:20px'>
                                <center>
                                <img style='width: 40%' src='https://1.bp.blogspot.com/-Bwoc6FKprQ8/XRECC8jNE-I/AAAAAAAAAkQ/m_RHJ_t3w5ErKBtNPIWqhWrdeSy2pbD7wCLcBGAs/s320/logo-color.png'>                                
                                <h2 style='font-weight:100; color:black'>DESAFIO POR BARDAS</h2>
                                <hr style='border:1px solid #ccc; width:90%'>
                                <h3 style='font-weight:100; color:black; padding:0 20px'><strong>Estimado ".$nombre." (DNI ".$dni.")</strong></h3><br>";
                     if($idEstadoPago!=""){
                         $suma=Pago::sumaTotalequipo($equipo->idEquipo);
                         $importe=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                         $resto=$importe->importe - $suma;
                         $body.="<h4 style='font-weight:100; color:black; padding:0 20px;'>El motivo del presente mail, es para solicitarte tengas a bien cancelar el pago de la inscripción. </h4>
                                <h4 style='font-weight:100; color:black; padding:0 20px'>Por favor acercate a los puntos donde puedes abonar el saldo de $".$resto."</h4>
                                <h4 style='font-weight:100; color:black; padding:0 20px'>Sin otro particular, te recordamos que la carrera se efectuará el día 08/09/2019.</h4>";
                                
                      }else{          
                       $body.="<h4 style='font-weight:100; color:black; padding:0 20px'>El motivo del presente mail, es para informarte que tu equipo ha sido desafectado del evento Desafío por bardas por falta del cumplimiento del pago de la inscripción. </h4>
                                <h4 style='font-weight:100; color:black; padding:0 20px'>Por cualquier consulta o dudas con respecto a esta situación, por favor comunicate con el administrador</h4>
                                <h4 style='font-weight:100; color:black; padding:0 20px'>Sin otro particular, te saludamos atte.</h4>";
                      }
                         
                    $body.="<br>
                                <hr style='border:1px solid #ccc; width:90%'>
                                <img style='padding:20px; width:60%' src='https://1.bp.blogspot.com/-kyzwnDvqRrA/XREB-8qtiJI/AAAAAAAAAkM/CMPVQEjwxDcHXyvMg62yuOt_bpY-SwDLgCLcBGAs/s320/placas%2B4-03.jpg'>
                                <h5 style='font-weight:100; color:black'>Este mensaje de correo electrónico se envió a ".$mailUsuario."</h5>    
                                <h5 style='font-weight:100; color:black'>Te invitamos a que veas nuestras redes sociales.</h5>
                                <a href='https://www.facebook.com/bienestaruncoma/'><img src='https://1.bp.blogspot.com/-BR60W75cIco/XREFTGbPHZI/AAAAAAAAAks/FQUMI8DkynoP69YnYRjGZ1ylnNeYhM5BwCLcBGAs/s320/facebook-logo.png' style='width: 7%'></a>
                                <a href='https://www.instagram.com/sbucomahue/'><img src='https://1.bp.blogspot.com/-NKIBF9SSXCU/XREFTOvwjII/AAAAAAAAAkw/cn679IM4LMQvcIMVCsgetU7gTDyM5DhwgCLcBGAs/s320/instagram-logo.png' style='width: 7%'></a>
                                </center>
                        </div>
                </div>";   
                Yii::$app->mailer->compose()
                //->setFrom('carreraxbarda@gmail.com')
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                ->setTo($mailUsuario)
                ->setSubject($subject)
                ->setHTMLBody($body)
                ->send();
                      
                             Yii::$app->session->setFlash('email');//enviamos mensaje si mando mail
                             return $this->refresh();
                      
            }else{
                Yii::$app->session->setFlash('nousu');//enviamos mensaje si no encontro usuario
                             return $this->refresh();
                
            }
         }
    }

    public function actionEnviamailactiva(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $mensaje='';
        if (Yii::$app->request->get()) {
          $idEstadoPago = Html::encode($_GET["id1"]);
          $idEquipo = Html::encode($_GET["id"]);
          $equipo=Equipo::findOne(['idEquipo'=>$idEquipo]);

          if($user=Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan])){//verificamos que exista el usuario
             $persona=Persona::findOne(['idUsuario'=>$user->idUsuario]);
            $dni = urlencode($user->dniUsuario);
            $mailUsuario = $user->mailUsuario;
            $nombre=$persona->nombrePersona." ".$persona->apellidoPersona;
           // echo '<pre>';echo $nombre;echo'</pre>';die();
            $subject = "Pago de la inscripción";// Asunto del mail
            //$host=Yii::$app->request->hostInfo;
            $body = "
                <div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                        <div class='col-lg-12 col-xs-6' style='position:relative; margin: auto; max-width: 500px; background:white; padding:20px'>
                                <center>
                                <img style='width: 40%' src='https://1.bp.blogspot.com/-Bwoc6FKprQ8/XRECC8jNE-I/AAAAAAAAAkQ/m_RHJ_t3w5ErKBtNPIWqhWrdeSy2pbD7wCLcBGAs/s320/logo-color.png'>                                
                                <h2 style='font-weight:100; color:black'>DESAFIO POR BARDAS</h2>
                                <hr style='border:1px solid #ccc; width:90%'>
                                <h3 style='font-weight:100; color:black; padding:0 20px'><strong>Estimado ".$nombre." (DNI ".$dni.")</strong></h3><br>
                     
                                <h4 style='font-weight:100; color:black; padding:0 20px'>El motivo del presente mail, es para informarte que tu equipo ha sido activado para el  evento Desafío por bardas, por lo tando deberás cumplimentar el pago de la inscripción. </h4>
                                <h4 style='font-weight:100; color:black; padding:0 20px'>Por cualquier consulta o dudas con respecto a esta situación, por favor comunicate con el administrador</h4>
                                <h4 style='font-weight:100; color:black; padding:0 20px'>Sin otro particular, te saludamos atte.</h4>
                      
                         
                            <br>
                                <hr style='border:1px solid #ccc; width:90%'>
                                <img style='padding:20px; width:60%' src='https://1.bp.blogspot.com/-kyzwnDvqRrA/XREB-8qtiJI/AAAAAAAAAkM/CMPVQEjwxDcHXyvMg62yuOt_bpY-SwDLgCLcBGAs/s320/placas%2B4-03.jpg'>
                                <h5 style='font-weight:100; color:black'>Este mensaje de correo electrónico se envió a ".$mailUsuario."</h5>    
                                <h5 style='font-weight:100; color:black'>Te invitamos a que veas nuestras redes sociales.</h5>
                                <a href='https://www.facebook.com/bienestaruncoma/'><img src='https://1.bp.blogspot.com/-BR60W75cIco/XREFTGbPHZI/AAAAAAAAAks/FQUMI8DkynoP69YnYRjGZ1ylnNeYhM5BwCLcBGAs/s320/facebook-logo.png' style='width: 7%'></a>
                                <a href='https://www.instagram.com/sbucomahue/'><img src='https://1.bp.blogspot.com/-NKIBF9SSXCU/XREFTOvwjII/AAAAAAAAAkw/cn679IM4LMQvcIMVCsgetU7gTDyM5DhwgCLcBGAs/s320/instagram-logo.png' style='width: 7%'></a>
                                </center>
                        </div>
                </div>";   
                Yii::$app->mailer->compose()
                //->setFrom('carreraxbarda@gmail.com')
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                ->setTo($mailUsuario)
                ->setSubject($subject)
                ->setHTMLBody($body)
                ->send();
                      
                             Yii::$app->session->setFlash('email');//enviamos mensaje si mando mail
                             return $this->refresh();
                      
            }else{
                Yii::$app->session->setFlash('nousu');//enviamos mensaje si no encontro usuario
                             return $this->refresh();
                
            }
         }
    }
    /**
     * Deletes an existing Estadopagoequipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete1($idEstadoPago="", $idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }else{
            return $this->goHome();
        }
            $equipo = Equipo::findOne($idEquipo);
            $grupos=Grupo::find()->Select('*')->where(['idEquipo'=>$equipo->idEquipo])->all();
            $transaction = Yii::$app->getDb()->beginTransaction(); // Iniciamos una transaccion
        try{
            foreach($grupos as $grupo){
                $grupocopia=new Grupocopia;
                $grupocopia->idEquipo=$grupo->idEquipo;
                $grupocopia->idPersona=$grupo->idPersona;
                $grupocopia->save();//copia grupo
                Grupo::findOne($grupo->idEquipo,$grupo->idPersona)->delete();
                $carreracopia=new Carrerapersonacopia;
                $carreracopia->idTipoCarrera=$equipo->idTipoCarrera;
                $carreracopia->idPersona=$grupo->idPersona;
                $carreracopia->reglamentoAceptado=1;
                $carreracopia->save();//copia carrera persona     
                Carrerapersona::findOne( $carreracopia->idTipoCarrera,$carreracopia->idPersona)->delete();
                   
            }
            
            $equipo->deshabilitado=1;//deshabilita equipo
            if($equipo->save()){
                $transaction->commit();
                return $this->redirect(['index1']);
            }else{
                $transaction->rollBack();
                return $this->redirect(['index1']);
            }
        }catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
          }
    }

    /**
     * Deletes an existing Estadopagoequipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActivar($idEstadoPago="", $idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }else{
            return $this->goHome();
        }
            $equipo = Equipo::findOne($idEquipo);
            $grupo=Grupocopia::find()->Select('*')->where(['idEquipo'=>$equipo->idEquipo])->all();
            $transaction = Yii::$app->getDb()->beginTransaction(); // Iniciamos una transaccion
        try{
            foreach($grupo as $persona){
                $grupo=new Grupo;
                $grupo->idEquipo=$persona->idEquipo;
                $grupo->idPersona=$persona->idPersona;
                $grupo->save();//copia grupo
                Grupocopia::findOne($persona->idEquipo,$persona->idPersona)->delete();//baja grupocopia
                $carrera=new Carrerapersona;
                $carrera->idTipoCarrera=$equipo->idTipoCarrera;
                $carrera->idPersona=$persona->idPersona;
                $carrera->reglamentoAceptado=1;
                $carrera->save();//copia carrera persona
                Carrerapersonacopia::findOne($carrera->idTipoCarrera, $carrera->idPersona)->delete();//baja carrerapersonacopia             
            }
            $equipo->deshabilitado=0;//activa equipo
            if($equipo->save()){
                $transaction->commit();
                return $this->redirect(['index1']);
            }else{
                $transaction->rollBack();
                return $this->redirect(['index1']);
            }
        }catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
          }
    }
    /**
     * Deletes an existing Estadopagoequipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idEstadoPago
     * @param integer $idEquipo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idEstadoPago="", $idEquipo)
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
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
