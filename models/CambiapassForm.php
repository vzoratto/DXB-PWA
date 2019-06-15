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

    public function rules()
    {
        return [
            [['dni','password','nuevo_password','repite_password'], 'required', 'message' => 'Campo requerido'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            ['dni', 'usuario_existe'],
            ['password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['nuevo_password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['repite_password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['nuevo_password', 'compare', 'compareValue' => 'password','operator' => '!='],
            ['repite_password', 'compare', 'compareAttribute' => 'nuevo_password', 'message' => 'Los passwords no coinciden'],
            
        ];
        
    }
    
    public function usuario_existe($attribute, $params)
    {
  //Buscar el username en la tabla
       $table = Usuario::find()->where("dniUsuario=:dniUsuario", [":dniUsuario" => $this->dni]);
  
  //Si el username existe mostrar el error
  if ($table->count() != 1)
  {
                $this->addError($attribute, "El usuario seleccionado no existe, comuni­quese con el administrador");
  }
    }
   
  
  
  
    
}