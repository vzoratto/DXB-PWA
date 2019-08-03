<?php

namespace app\controllers;

use Yii;
use app\models\Controlpago;
use app\models\ControlpagoSearch;
use app\models\Permiso;
use app\models\Usuario;
use app\models\Gestores;
use app\models\Importeinscripcion;
use app\models\Pago;
use app\models\Estadopagoequipo;
use app\models\Persona;
use app\models\Equipo;
use yii\web\IdentityInterface;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ControlpagoController implements the CRUD actions for Controlpago model.
 */
class ControlpagoController extends Controller
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
     * Lists all Controlpago models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new ControlpagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Controlpago model.
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
        //$model=$this->findModel($id);
        $model=Controlpago::findOne(['idPago'=>$id]);
        $gestor=Gestores::findOne(['idGestor'=>$model->idGestor]);
        $usuario=Usuario::findOne(['idUsuario'=>$gestor->idUsuario]);

        return $this->render('view', [
            'model' => $model,
            'gestor'=> $gestor,//nombreGestor
            'usuario'=>$usuario,//dniusuario
        ]);
    }

    /**
     * Creates a new Controlpago model.
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
        $model = new Controlpago();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idControlpago]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Controlpago model.
     * chequea el pago realizado por el participante y llena la gabla estado pago.
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
        $estado='';
        $usuario= Usuario::findIdentity($_SESSION['__id']);//objeto usuario
        $gestor=Gestores::findOne(['idUsuario'=>$_SESSION['__id']]); //objeto gestor
        if ($model->load(Yii::$app->request->post())){
            $model->chequeado=1;// 0 no chequeado, 1 chequeado
            $model->idGestor=$gestor->idGestor;
            $pago=Pago::findOne(['idPago'=>$model->idPago]);
            $equipo=Equipo::findOne(['idEquipo'=>$pago->idEquipo]);
            $importe=Importeinscripcion::findOne(['idImporte'=>$pago->idImporte]);
            $costo=$importe->importe * $equipo->cantidadPersonas;
            //echo '<pre>';echo $costo;echo $pago->importePagado;echo '</pre>';die();
            if($costo == $pago->importePagado){
                $estado=1;//pago total
            }elseif($costo < $pago->importePagado){
                    Yii::$app->session->setFlash('pagoGrande');//enviamos mensaje si ingreso mas dinero
                    return $this->refresh();
            }else{
                    $suma=Pago::sumaEquipo($pago->idEquipo);//suma los pagos parciales chequeados
                    $sumapago=$suma + $pago->importePagado;
                   // echo '<pre>';echo $suma;echo '</pre>';die();
                    if($costo == $sumapago){
                         $estado=3;//pago cancelo
                    }elseif($costo > $sumapago){
                         $estado=2;//pago parcial
                    }else{
                        Yii::$app->session->setFlash('pagoGrande');//enviamos mensaje si ingreso mas dinero
                        return $this->refresh();
                    }
                 
            }
           if($model->save()) {//chequea el pago en controlpago
             
              // actualiza el estado  pago del equipo si existe
              if($model1=Estadopagoequipo::findOne(['idEquipo'=>$pago->idEquipo])){
                  $model1->idEstadoPago=$estado;
              }else{
                  $model1=new Estadopagoequipo;//ingresa el estado pago del equipo si no existe
                  $model1->idEstadoPago=$estado;
                  $model1->idEquipo=$pago->idEquipo;
              }
             if($model1->save()){//llena tabla estado pago del equipo
                $persona=Persona::findOne(['idPersona'=>$pago->idPersona]);
                $user=Usuario::findOne(['idUsuario'=>$persona->idUsuario]);
                $dni = urlencode($user->dniUsuario);
                    $mailUsuario = $user->mailUsuario;//envia mail de acreditacion del pago chequeado
                    $subject = "Acreditación pago realizado";// Asunto del mail
                    $body = "
                        <div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                                <div style='position:relative; margin:auto; width:600px; background:white; padding:20px'>
                                        <center>
                                        <img style='width: 40%' src='https://1.bp.blogspot.com/-Bwoc6FKprQ8/XRECC8jNE-I/AAAAAAAAAkQ/m_RHJ_t3w5ErKBtNPIWqhWrdeSy2pbD7wCLcBGAs/s320/logo-color.png'>                                
                                        <h2 style='font-weight:100; color:#999'>DESAFIO POR BARDAS</h2>
                                        <hr style='border:1px solid #ccc; width:90%'>
                                        <h3 style='font-weight:100; color:#999; padding:0 20px'><strong>Tu pago por $".$pago->importePagado." fue acreditado exitosamente. </strong></h3><br>
                                        <h4 style='font-weight:100; color:#999; padding:0 20px'>Gracias por participar.</h4>
                                        <br>
                                        <hr style='border:1px solid #ccc; width:90%'>
                                        <img style='padding:20px; width:60%' src='https://1.bp.blogspot.com/-kyzwnDvqRrA/XREB-8qtiJI/AAAAAAAAAkM/CMPVQEjwxDcHXyvMg62yuOt_bpY-SwDLgCLcBGAs/s320/placas%2B4-03.jpg'>
                                        <h5 style='font-weight:100; color:#999'>Este mensaje de correo electrónico se envió a ".$mailUsuario."</h5>                                       
                                        <h5 style='font-weight:100; color:#999'>Te invitamos a que veas nuestras redes sociales.</h5>
                                        <a href='#'><img src='https://1.bp.blogspot.com/-BR60W75cIco/XREFTGbPHZI/AAAAAAAAAks/FQUMI8DkynoP69YnYRjGZ1ylnNeYhM5BwCLcBGAs/s320/facebook-logo.png' style='width: 7%'></a>
                                        <a href='#'><img src='https://1.bp.blogspot.com/-xhmzOVdv0xc/XREFTPz-ZyI/AAAAAAAAAk0/y2OOhH7A1fgRSswuqDkcKaRRkPMFkwEEwCLcBGAs/s320/twitter-logo.png' style='width: 7%'></a>
                                        <a href='#'><img src='https://1.bp.blogspot.com/-NKIBF9SSXCU/XREFTOvwjII/AAAAAAAAAkw/cn679IM4LMQvcIMVCsgetU7gTDyM5DhwgCLcBGAs/s320/instagram-logo.png' style='width: 7%'></a>
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
                Yii::$app->session->setFlash('pagoCheck');//enviamos mensaje si chequeo
                return $this->refresh();
            } 
         }else{
             Yii::$app->session->setFlash('pagonoCheck');//enviamos mensaje no chequeo
                return $this->refresh();
         }
     }//renderiza a la vista para chequear el pago
        return $this->render('update', [
            'model' => $model,
            'gestor'=>$gestor,//idgestor, nombre gestor
            'usuario'=>$usuario,//idUauadio, dniUsuario
        ]);
    }

    /**
     * Deletes an existing Controlpago model.
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Controlpago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Controlpago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Controlpago::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}