<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    
    public $email;
    public $subject;
    public $body;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email, subject and body are required
            [['email', 'subject', 'body'], 'required','message' => 'Campo requerido'],
            // email has to be a valid email address
            ['email', 'email','message' => 'Formato incorrecto'],
            
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        $content = "<p>Email: " . $this->email . "</p>";
        $content .= "<p>Subject: " . $this->subject . "</p>";
        $content .= "<p>Body: " . $this->body . "</p>";
        if ($this->validate()) {
            Yii::$app->mailer->compose(["content" => $content])
                ->setTo($email)
                ->setFrom([$this->email])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
