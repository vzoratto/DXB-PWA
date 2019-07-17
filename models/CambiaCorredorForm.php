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
class CambiaCorredorForm extends Model
{
    public $dniCorredor;
    public $dniUsuario;
    
    private $_user=false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
			[['dniCorredor', 'dniUsuario'], 'required', 'message' => 'Campo requerido'],
            [['dniCorredor', 'dniUsuario'],'match', 'pattern' => "/^.{8,8}$/", 'message' => 'Mi­nimo y maximo 8 caracteres'],
            [['dniCorredor',' dniUsuario'],'match', 'pattern' => "/^[0-9]+$/", 'message' => 'Solo se aceptan numeros'],
            ['dniCorredor','validateDnic'],
            ['dniUsuario','validateDni'],
          ];
    }
 /**
     * Validates the dni.
     * This method serves as the inline validation for dni.
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateDnic($attribute, $params){
  
        if (!$this->hasErrors()) {
            $user = $this->getUserc();
            if ($user==null) {
                $this->addError($attribute, 'DNI corredor ingresado no existe.');
            }   
        }
    }
  
    /**
     * Finds user by [[dni]]
     * @return User|null
     */
    public function getUserc()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::find()->where(['dniUsuario'=>$this->dniCorredor])->One();
        }
        return $this->_user;
    }
    
    /**
     * Validates the dni.
     * This method serves as the inline validation for dni.
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateDni($attribute, $params){
  
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user==null) {
                $this->addError($attribute, 'DNI usuario ingresado no existe.');
            }   
        }
    }
  
    /**
     * Finds user by [[dni]]
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::find()->where(['dniUsuario'=>$this->dniUsuario])->One();
        }
        return $this->_user;
    }
    
}
