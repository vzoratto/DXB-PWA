<?php
namespace app\models;


use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CambiaCapitanForm extends Model
{
    public $dniCapitan;
    public $dniUsuario;
    


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
			[['dniCapitan', 'dniUsuario'], 'required', 'message' => 'Campo requerido'],
            [['dniCapitan', 'dniUsuario'],'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            [['dniCapitan',' dniUsuario'],'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            
            
            
        ];
    }

    
}
