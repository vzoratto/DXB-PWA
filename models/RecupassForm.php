<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;


/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RecupassForm extends Model
{
    public $dni;
    public $email;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
			[['dni', 'email'], 'required', 'message' => 'Campo requerido'],
            ['dni', 'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            ['dni', 'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            ['dni','validaDni'],
            ['email','email','message'=>'Formato incorrecto'],
        ];
    }

    public function validaDni($attribute, $params)
    {
       //Buscar el username en la tabla
        $table = Usuario::find()->where("dniUsuario=:dniUsuario", [":dniUsuario" => $this->dni]);
        //Si el username existe mostrar el error
        if ($table->count() != 1)
        {
                $this->addError($attribute, "El usuario seleccionado no existe, verificar los datos.");
         }
    }

}
    
