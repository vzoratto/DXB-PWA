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

    private $_user = false;
    
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
            ['email','email','message'=>'Formato incorrecto'],
            // password is validated by validatePassword()
            ['email', 'validateMail'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateMail($attribute, $params){
  
      if (!$this->hasErrors()) {
          $user = $this->getUser();

          if (!$user || !$user->validateMail($this->email)) {
              $this->addError($attribute, 'Dni o email incorrecto.');
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
     * Envio de email para la recuperacion del password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = Usuario::findOne([
            'activado' => 1,
            'dniUsuario' => $this->dni,
        ]);
        if ($user) {
            if ($user->save()) {
                $dni = urlencode($user->dniUsuario);
                $authkey = urlencode($user->authkey);
                $pass=urlencode($user->claveUsuario);
             $subject = "Recuperar password";//accion validar mail
             $body = "<h3>Se le envia un codigo que deberas ingresar como password para loguearte,</h3>";
             $body .= "<h3>Recuerda, que luego deberas cambiar el password enviado por uno personalizado.</h3>";
             $body .= "<h3>El password : ".$pass."</h3>";
             $body .= "<h3>Haga click en el siguiente enlace para finalizar la recuperacion del password</h3>";
             $body .= "<a href='http://localhost/carrera/web/index.php?r=site/activarcuenta&d=".$dni."&c=".$authkey."'>Recuperar Password</a>";
                  
              return    Yii::$app->mailer->compose()
                  ->setFrom('carreraxbarda@gmail.com')
                  //->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                  ->setTo($user->mailUsuario)
                  ->setSubject($subject)
                  ->setHTMLBody($body)
                  ->send();
               /* return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();*/
            }
        }
        return false;
    }

}
    
