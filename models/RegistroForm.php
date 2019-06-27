<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

    /**
     * Registro form
     */
    class RegistroForm extends Model
    {
        public $dni;
        public $email;
        public $password;
        public $repite_password;

        private $_user = false;

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
            [['dni', 'email', 'password','repite_password'], 'trim'],
            [['dni', 'email', 'password','repite_password'], 'required', 'message' => 'Campo requerido'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            ['dni','validateDni'],
            ['email', 'email', 'message' => 'Formato no valido'],
            ['password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['repite_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
            ];
        }

        /**
     * Validates the dni.
     * This method serves as the inline validation for dni.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateDni($attribute, $params){
  
        if (!$this->hasErrors()) {
            $user = $this->getUser();
  
            if ($user) {
                $this->addError($attribute, 'DNI ingresado ya existe.');
            }   
        }
    }
  
    /**
     * Finds user by [[dni]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::find()->where(['dniUsuario'=>$this->dni])->One();
        }
      
        return $this->_user;
    }
        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
        public function signup()
        {
            
            if ($this->validate()) {
                $user = new Usuario();
                $user->dniUsuario = $this->dni;
                $user->mailUsuario = $this->email;
                $user->claveUsuario=crypt($this->password, Yii::$app->params["salt"]);//Encriptamos el password
                $user->authkey = $this->randKey("carrerabarda", 50);//clave será utilizada para activar el usuario
                $user->activado=0;
                $user->idRol=1;
                if ($user->save()) {
                    $dni = urlencode($user->dniUsuario);
                    $mailUsuario = $user->mailUsuario;
                    $authkey = urlencode($user->authkey);
                    $subject = "Validar direccion de correo";// Asunto del mail
                    $body = "
                        <div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                                <div class='col-lg-12 col-xs-6' style='position:relative; margin: auto; max-width: 500px; background:white; padding:20px'>

                                        <center>


                                        <img style='width: 40%' src='https://1.bp.blogspot.com/-Bwoc6FKprQ8/XRECC8jNE-I/AAAAAAAAAkQ/m_RHJ_t3w5ErKBtNPIWqhWrdeSy2pbD7wCLcBGAs/s320/logo-color.png'>                                

                                        <h2 style='font-weight:100; color:black'>DESAFIO POR LAS BARDAS</h2>

                                        <hr style='border:1px solid #ccc; width:90%'>
                                        <h3 style='font-weight:100; color:black; padding:0 20px'><strong>Su registro se completo exitósamente. </strong></h3><br>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>Gracias por registrarse en Desafio por Bardas</h4>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>Para finalizar su registro y poder inscribirse a la carrera, por favor valide su cuenta ingresando al siguiente enlace</h4>

                                        <a href='http://localhost/carrera/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."' style='text-decoration:none'>

                                        <div style='line-height:60px; background:#ff8f04; width:60%; color:white'>Validar cuenta</div>

                                        </a>

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
       
        				  
                   return Yii::$app->mailer->compose()
                        //->setFrom('carreraxbarda@gmail.com')
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                        ->setTo($mailUsuario)
                        ->setSubject($subject)
                        ->setHTMLBody($body)
                        ->send();
                    
                }
            }
            return null;
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
    }
 
