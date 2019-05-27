<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\models\Usuario;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistroForm;
use app\models\Permiso;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */public $usuario_log;

     public function init() {
        $this->usuario_log = (!empty($_SESSION["__id"])) ? $_SESSION["__id"] : "0";
    }


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index,view,create,update,delete'],
                'rules' => [
                    [
                        'actions' => ['index,view,create,update,delete,admin,logout'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('administrador') && Permiso::requerirActivo('activo');
                        }
                    ],
                    [
                        'actions' => ['index,view,create,admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=>function($rule,$action){
                            return Permiso::requerirRol('gestor') && Permiso::requerirActivo('activo');
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
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
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

    public function actionRegistro() {//este
		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
			//Creamos la instancia con el model de validación
            $model = new RegistroForm;
   
           //Mostrará un mensaje en la vista cuando el usuario se haya registrado
            $mensaje = null;
            
          //Validación mediante ajax
          if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          }
          //También previene por si el usuario tiene desactivado javascript y la
          //validación mediante ajax no puede ser llevada a cabo
          if ($model->load(Yii::$app->request->post())){
              if($model->validate()){
                //echo "<pre>";print_r($model);echo "</pre>";
               
                //Preparamos la consulta para guardar el usuario
                $tabla = new Usuario();
				  if ($tabla->getUsuario($model->dni)) {
                     
                       $tabla->dniUsuario=$model->dni;
                       //Encriptamos el password
                       $tabla->claveUsuario = crypt($model->password, Yii::$app->params["salt"]);
                       $tabla->mailUsuario = $model->email;
                       $tabla->authkey = $this->randKey("carrerabarda", 50);//clave será utilizada para activar el usuario
                       $tabla->activado=0;
                       $tabla->idRol=1;
                       //echo "<pre>";var_dump($tabla);echo "</pre>";
                      
                       if ($tabla->save()){     //Si el registro es guardado correctamente
                       
						   $dni = urlencode($model->dni);
                           $authkey = urlencode($tabla->authkey);
					      //accion validar mail
						  $subject = "Confirmar registro";
                          $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                          $body .= "<a href='http://localhost/carrera/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."'>Confirmar</a>";
						  
                          Yii::$app->mailer->compose()
                          ->setFrom('carreraxbarda@gmail.com')
                          //->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                          ->setTo($model->email)
                          ->setSubject($subject)
                          ->setHTMLBody($body)
                          ->send();
                           
						   $model->dni = null;
                           $model->password = null;
                           $model->email = null;
                           
                           $mensaje = "Enviamos un email de verificacion y/o activacion a su correo, abralo para activar su cuenta";
                           return $this->render('error', ['mensaje' => $mensaje]);
                       }else{
                           $mensaje = "Ha ocurrido un error al llevar a cabo tu registro,vuelve a intentarlo";
                           return $this->render('registro', ['model' => $model,'mensaje' => $mensaje]);
                        }   
				  }else{ 
                     $mensaje = "Ya existe el numero de documento, por favor contactese con la administracion.";
					 return $this->render('error', ['mensaje' => $mensaje]);
                  }	   
		      }else{
                $mensaje = "Ya existe el numero de documento, por favor contactese con la administracion.";
                return $this->render('error', ['mensaje' => $mensaje]);
                }
     
             }
             return $this->render('registro', [
                'model' => $model,
                'mensaje'=> $mensaje,
            ]); 
  }

  public function actionActivarcuenta() {//este
        
    $usuario = new Usuario();
     if (Yii::$app->request->get()){
        //Obtenemos el valor de los parámetros get dni y authkey
        $dni = Html::encode($_GET["d"]);
        $authkey = $_GET["c"];
    
        $usuActivar = Usuario::getElusuario($dni,$authkey);
                          //->where(["dniUsuario" => $d])
                          //->andWhere(["authKey" => $c])->one();

       if (!empty($usuActivar)) {
            $activar = Usuario::findIdentity($usuActivar->idUsuario);
            $activar->activado = 1;
            if ($activar->save()){
                    //login automatico
                   //$modelo = new LoginForm();
                   //$modelo->username = $usuActivar->dniUsuario;
                   //$modelo->password = $usuActivar->claveUsuario;
                   
                    //if ($modelo->login()) {
                        //return $this->goHome();
                    //}
                  Yii::$app->getResponse()->redirect(Url::to(['site/login']));
           } else {
               // if(!Yii::$app->user->isGuest){Yii::$app->user->logout();}
               $mensaje="No existe usuario registrado con ese numero de documento, redireccionando ...";
               $mensaje.= "<meta http-equiv='refresh' content='8; ".$this->goBack()."'>";
               return $this->render('error', ['mensaje' => $mensaje]);
            }
       }else{
             $mensaje="No se pudo activar la cuenta, comunicate con el administrador";
             $mensaje.= "<meta http-equiv='refresh' content='10; ".$this->goBack()."'>";
             return $this->render('error', ['mensaje' => $mensaje]);
       }
     }else{
      $mensaje="Ups!! hubo un inconveniente, vuelva a intentarlo, redireccionando ...";
      $mensaje.= "<meta http-equiv='refresh' content='8; ".$this->goBack()."'>";
      return $this->render('error', ['mensaje' => $mensaje]);
     }
}
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function admin(){
        $usuAdmin=\app\models\Usuario::findOne($_SESSION["__id"]);
        if(Permiso::requerirRol('$usuAdmin->descripcionRol') && Permiso::requerirActivo('$usuAdmin->activado')){
            return $this->render('administar', [
                'model' => $usuAdmin->descripcionRol,
            ]); 
        }
    }

}
