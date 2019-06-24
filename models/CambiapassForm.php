<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Usuario;

class CambiapassForm extends Model{

    public $dni;
    public $password;
    public $nuevo_password;
    public $repite_password;
    private $_user = false;

    public function rules()
    {
        return [
            [['dni','password','nuevo_password','repite_password'], 'required', 'message' => 'Campo requerido'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            ['password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['password', 'validatePassword'],
            ['nuevo_password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['nuevo_password', 'compare', 'compareAttribute' => 'password','operator' => '!=','message' => 'Password y nuevo password deben ser distintos'],
            ['repite_password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['repite_password', 'compare', 'compareAttribute' => 'nuevo_password', 'message' => 'Nuevo password y repite password no coinciden'],

        ];

    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params){

        if (!$this->hasErrors()) {
            $user = $this->getUser();
  
            if (!$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Contraseña incorrecto.');
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
            $this->_user = Usuario::findByUsername($this->dni);
        }

        return $this->_user;
    }

          /**
       * Valida el cambio del password.
       *
       * @return boolean
       */
      public function validaCambio()
      {
          /* @var $user Usuario */
          $user = Usuario::findOne([
              'dniUsuario' => $this->dni,
          ]);
          if ($user) {
              $user->claveUsuario=crypt($this->nuevo_password, Yii::$app->params["salt"]);//Encriptamos el password
              if ($user->save()) {
                 return true;
            }
        }
          return false;

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
