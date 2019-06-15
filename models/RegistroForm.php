<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Usuario;
use app\models\Rol;

class RegistroForm extends Model{
 
    public $dni;
    public $email;
    public $password;
    public $repite_password;
    
    public function rules()
    {
        return [
            [['dni', 'email', 'password','repite_password'], 'required', 'message' => 'Campo requerido'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            ['dni', 'usuario_existe'],
            ['email', 'match', 'pattern' => "/^.{12,100}$/", 'message' => 'Mi­nimo 12 y maximo 100 caracteres'],
           
            ['email', 'email', 'message' => 'Formato no valido'],
            
            ['password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['repite_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
            
        ];
        
    }
    
    
 
    public function usuario_existe($attribute, $params)
    {
  //Buscar el username en la tabla
       $table = Usuario::find()->where("dniUsuario=:dniUsuario", [":dniUsuario" => $this->dni]);
  
  //Si el username existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El usuario seleccionado existe, comuni­quese con el administrador");
  }
    }
 
}