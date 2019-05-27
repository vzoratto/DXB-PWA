<?php

namespace app\models;
use Yii;
use yii\base\model;
use app\models\Usuario;

class RegistroForm extends Model{
 
    public $dni;
    public $email;
    public $password;
   
    
    public function rules()
    {
        return [
            [['dni', 'email', 'password'], 'required', 'message' => 'Campo requerido'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'MÃ­nimo y mÃ¡ximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'SÃ³lo se aceptan nÃºmeros'],
            ['dni', 'usuario_existe'],
            ['email', 'match', 'pattern' => "/^.{12,100}$/", 'message' => 'MÃ­nimo 12 y mÃ¡ximo 100 caracteres'],
           
            ['email', 'email', 'message' => 'Formato no vÃ¡lido'],
            
            ['password', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'MÃ­nimo y mÃ¡ximo 8 caracteres'],
            
        ];
        
    }
    
    
 
    public function usuario_existe($attribute, $params)
    {
  //Buscar el username en la tabla
  $table = Usuario::find()->where("dniUsuario=:dniUsuario", [":dniUsuario" => $this->dni]);
  
  //Si el username existe mostrar el error
  if ($table->count() == 1)
  {
                $this->addError($attribute, "El usuario seleccionado existe, comunÃ­quese con el administrador");
  }
    }
 
}