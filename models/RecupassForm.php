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
            //obtenemos el host del servidor para el envio de email
            $host=Yii::$app->request->hostInfo;
            $pass="XmWq9081";
            $user->claveUsuario=crypt($pass, Yii::$app->params["salt"]);//Encriptamos el password
            if ($user->save()) {
             $subject = "Recuperar password";//accion validar mail

                $body = "<div style='width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px'>
                                <div class='col-lg-12 col-xs-6' style='position:relative; margin: auto; max-width: 500px; background:white; padding:20px'>

                                        <center>


                                        <img style='width: 40%' src='https://1.bp.blogspot.com/-Bwoc6FKprQ8/XRECC8jNE-I/AAAAAAAAAkQ/m_RHJ_t3w5ErKBtNPIWqhWrdeSy2pbD7wCLcBGAs/s320/logo-color.png'>

                                        <h2 style='font-weight:100; color:black'><strong>DESAFIO POR BARDAS</strong></h2>

                                        <hr style='border:1px solid #ccc; width:90%'>
                                        <h3 style='font-weight:100; color:black; padding:0 20px'>Se te envía un código que deberás ingresar como contraseña para loguearte. <br> Recuerda, que luego deberás cambiar la contraseña enviada por una personalizada.</h3><br>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>La contraseña es :<strong> ".$pass."</strong></h4>
                                        <h4 style='font-weight:100; color:black; padding:0 20px'>Hace click en el siguiente enlace para finalizar la recuperación de la contraseña.</h4>

                                        <a href='$host/index.php?r=site/cambiapass' style='text-decoration:none'>

                                        <div style='line-height:60px; background:#ff8f04; width:60%; color:white'>Inicio</div>

                                        </a>

                                        <br>

                                        <hr style='border:1px solid #ccc; width:90%'>

                                        <img style='padding:20px; width:60%' src='https://1.bp.blogspot.com/-iT_-pQzmOPo/XREg3ohXqnI/AAAAAAAAAlg/YGQRUExWZOIfmsHgaeiwb4RK7yZA4MgUACLcBGAs/s320/placas%2B5-02.jpg'>

                                        <h5 style='font-weight:100; color:black'>Te invitamos a que veas nuestras redes sociales.</h5>

                                        <a href='https://www.facebook.com/bienestaruncoma/'><img src='https://1.bp.blogspot.com/-BR60W75cIco/XREFTGbPHZI/AAAAAAAAAks/FQUMI8DkynoP69YnYRjGZ1ylnNeYhM5BwCLcBGAs/s320/facebook-logo.png' style='width: 7%'></a>
                                        <a href='https://www.instagram.com/sbucomahue/'><img src='https://1.bp.blogspot.com/-NKIBF9SSXCU/XREFTOvwjII/AAAAAAAAAkw/cn679IM4LMQvcIMVCsgetU7gTDyM5DhwgCLcBGAs/s320/instagram-logo.png' style='width: 7%'></a>

                                        </center>

                                </div>

                        </div>";

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
