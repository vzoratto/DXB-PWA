<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url; 
use app\models\Usuario;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistroForm;
use app\models\RecupassForm;
use app\models\CambiapassForm;
use app\models\Permiso;

class SiteController extends Controller
{
    public $usuario_log;
    /**
     * {@inheritdoc}
     */

     public function init() {
        $this->usuario_log = (!empty($_SESSION['__id'])) ? $_SESSION['__id'] : 0;
    }


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index,view,create,update,delete','recupass'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login','registro','recupass'],
                        'roles' => ['?'],
                    ],

                    [
                        'actions' => ['index,view,create,update,delete,logout, admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('administrador') && Permiso::requerirActivo(1);
                        }
                    ],
                    [
                        'actions' => ['index,view,create,logout'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('gestor') && Permiso::requerirActivo(1);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        $mensaje="";
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Permiso::requerirActivo(0)){// no activado=1
                Yii::$app->user->logout();
                if (Yii::$app->user->isGuest) {
                $mensaje = "Enviamos un email de verificacion y/o activacion a tu correo, abrelo para activar tu cuenta";
                return $this->render('correo', ['mensaje' => $mensaje]);
                // return $this->redirect(site/enviomail)
                }
            }else{
                if (Permiso::requerirRol('administrador')){
                    return $this->redirect(["site/admin"]);
                }elseif(Permiso::requerirRol('gestor')){
                    return $this->redirect(["carrerapersona/index"]); 
                }   
            }
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    /**
     * funcion random para claves,long 50 hexa
     */
    private function randKey($str='', $long=0){//este
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
    /**
     * funcion registro de usuarios
     */
    public function actionRegistro() {//este
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
            $model = new RegistroForm;
            $mensaje = null;//Mostrará un mensaje
          if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){ //Validación mediante ajax
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          }
          if ($model->load(Yii::$app->request->post())){ //previene por si el usuario tiene desactivado javascript
              if($model->validate()){
                $tabla = new Usuario();
				  if (!$tabla->getUsuario($model->dni)) {
                       $tabla->dniUsuario=$model->dni;
                       $tabla->claveUsuario = crypt($model->password, Yii::$app->params["salt"]);//Encriptamos el password
                       $tabla->mailUsuario = $model->email;
                       $tabla->authkey = $this->randKey("carrerabarda", 50);//clave será utilizada para activar el usuario
                       $tabla->activado=0;
                       $tabla->idRol=1;
                       if ($tabla->save()){     
                        $dni = urlencode($tabla->dniUsuario);
                     $authkey = urlencode($tabla->authkey);
				     $subject = "Confirmar registro";//accion validar mail
                     $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                     $body .= "<a href='http://localhost/carrera/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."'>Confirmar</a>";
						  
                          Yii::$app->mailer->compose()
                          //->setFrom('carreraxbarda@gmail.com')
                          ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                          ->setTo($tabla->mailUsuario)
                          ->setSubject($subject)
                          ->setHTMLBody($body)
                          ->send();
                           //vaciamos valores
						   $model->dni = null; $model->password = null; $model->email = null;
                           $mensaje = "Enviamos un email de verificacion y/o activacion a tu correo, abrelo para activar tu cuenta";
                           return $this->render('correo', ['mensaje' => $mensaje]);
                       
                       }else{
                           $model->dni = null; $model->password = null; $model->email = null;
                           $mensaje = "Ha ocurrido un error al llevar a cabo tu registro,vuelve a intentarlo";
                           return $this->render('registro', ['model' => $model,'mensaje' => $mensaje]);
                        }   
				  }else{  
                     $mensaje = "Ya existe el numero de documento, por favor contactate con la administracion.";
					 return $this->render('error', ['mensaje' => $mensaje]);
                  }	   
		      }else{
                $mensaje = "Los datos no se pudieron validar, por favor contactate con la administracion.";
                return $this->render('error', ['mensaje' => $mensaje]);
                }
             }
             $model->dni = null; $model->password = null; $model->email = null;
             return $this->render('registro', [
                'model' => $model,
                'mensaje'=> $mensaje,
            ]); 
  }
    /**
     * Displays recupera password.
     *
     * @return string
     */
       public function actionRecupass() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RecupassForm();
         $mensaje = null;//Mostrará un mensaje
       //Validación mediante ajax
       if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
         Yii::$app->response->format = Response::FORMAT_JSON;
         return ActiveForm::validate($model);
       }
       if ($model->load(Yii::$app->request->post())){//previene por si el usuario tiene desactivado javascript
           if($model->validate()){
             $tabla = new Usuario();
               if ($tabla->getUsuario($model->dni)) {
                    $tabla->dniUsuario=$model->dni;
                    $tabla->claveUsuario = $this->randKey("123", 8);//Encriptamos el password
                    $tabla->mailUsuario = $model->email;
                    if ($tabla->save()){     
                     $dni = urlencode($tabla->dniUsuario);
                     $authkey = urlencode($tabla->authkey);
                     $pass=urlencode($tabla->claveUsuario);
                  $subject = "Recuperar password";//accion validar mail
                  $body = "<h1>Se le envia un codigo que debera ingresar como password para loguearse,</h1>";
                  $body .= "<h1>Recuerde que luego debera cambiar la password enviada por una suya personalizada.</h1>";
                  $body .= "<h1>El password generado y que debera ingresar en el formulario login es  ".$pass."</h1>";
                  $body .= "<h1>Haga click en el siguiente enlace para finalizar la recuperacion del password</h1>";
                  $body .= "<a href='http://localhost/carrera/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."'>Recuperar Password</a>";
                       
                       Yii::$app->mailer->compose()
                       ->setFrom('carreraxbarda@gmail.com')
                       //->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                       ->setTo($tabla->mailUsuario)
                       ->setSubject($subject)
                       ->setHTMLBody($body)
                       ->send();
                        //vaciamos valores
                        $model->dni = null;$model->email = null;
                        $mensaje = "Enviamos un email de recuperacion de password a tu correo, abrelo para activar tu cuenta";
                        return $this->render('correo', ['mensaje' => $mensaje]);
                    }else{
                        $model->dni = null;$model->email = null;
                        $mensaje = "Ha ocurrido un error al llevar a cabo tu registro,vuelve a intentarlo";
                        return $this->render('recupass', ['model' => $model,'mensaje' => $mensaje]);
                     }   
               }else{  
                  $mensaje = "Ya existe el numero de documento, por favor contactate con la administracion.";
                  return $this->render('error', ['mensaje' => $mensaje]);
               }	   
           }else{
             $mensaje = "Ya existe el numero de documento, por favor contactate con la administracion.";
             return $this->render('error', ['mensaje' => $mensaje]);
             }
          }
          $model->dni = null;$model->email = null;
          return $this->render('recupass', [
             'model' => $model,
             'mensaje'=> $mensaje,
         ]); 
 }
    /**
     * Displays activa cuenta.
     *
     * @return string
     */
     public function actionActivarcuenta() {
     if (Yii::$app->request->get()){
        $dni = Html::encode($_GET["d"]);
        $authkey =Html::encode($_GET["c"]);
        $usuActivar = Usuario::getElusuario($dni,$authkey);
       if (!empty($usuActivar)) {
            $activar = Usuario::findOne($usuActivar->idUsuario);
            $activar->activado = 1;
            // ($activar->getErrors()) ;
            if ($activar->save()){
                        echo "Perfecto registro llevado a cabo correctamente, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                            //echo Url::to('site/login');//redirige al login 
           } else {
               $mensaje="No se pudo activar la cuenta, comunicate con el administrador";
               return $this->render('error', ['mensaje' => $mensaje]);
            }
       }else{
             $mensaje="No existe usuario registrado con ese numero de documento, vuelva a intentarlo";
             return $this->render('error', ['mensaje' => $mensaje]);
       }
     }else{
      $mensaje="Ups!! hubo un inconveniente, vuelva a intentarlo, redireccionando ...";
      return $this->render('error', ['mensaje' => $mensaje]);
     }
}
    /**
     * Displays cambia password.
     *
     * @return string
     */
    public function actionCambiapass(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new CambiaPassForm();
         $mensaje = null;//Mostrará un mensaje
       if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){ //Validación mediante ajax
         Yii::$app->response->format = Response::FORMAT_JSON;
         return ActiveForm::validate($model);
       }
       if ($model->load(Yii::$app->request->post())){//También previene por si el usuario tiene desactivado javascript
          if($model->validate()){
            if($tabla =Usuario::findOne($model->dni)){
                    $tabla->dniUsuario=$model->dni;
                    $tabla->claveUsuario = crypt($model->nuevo_password, Yii::$app->params["salt"]); //Encriptamos el password
                    if ($tabla->save()){ 
                        $model->dni=null;$model->password=null;$model->nuevo_password=null;$model->repite_password=null;
                        echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";        
                    }else{
                        $mensaje="No se pudo cambiar el password, vuelva a intentarlo";
                        return $this->render('error', ['mensaje' => $mensaje]);
                    }
                }else{
                    $mensaje="No existe usuario registrado con ese numero de documento, vuelva a intentarlo";
                    return $this->render('error', ['mensaje' => $mensaje]);
                }
            }else{
                $mensaje="Ups!! hubo un inconveniente, vuelva a intentarlo, redireccionando ...";
                return $this->render('error', ['mensaje' => $mensaje]);
            }
        }
            $model->dni=null;$model->password=null;$model->nuevo_password=null;$model->repite_password=null;
            return $this->render('cambiapass', [
                'model' => $model,
                'mensaje'=> $mensaje,
            ]); 
   }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout(){
        return $this->render('about');
    }

    /**
     * Displays admin page.
     *
     * @return string
     */
    public function actionAdmin(){
            return $this->render('administrar');
    }

}
