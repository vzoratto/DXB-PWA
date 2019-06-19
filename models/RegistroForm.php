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
                    $authkey = urlencode($user->authkey);
			        $subject = "Confirmar registro";//accion validar mail
                    $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                    $body .= "<a href='http://localhost/carrera/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."'>Confirmar</a>";
						  
                   return Yii::$app->mailer->compose()
                        //->setFrom('carreraxbarda@gmail.com')
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                        ->setTo($user->mailUsuario)
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
 
