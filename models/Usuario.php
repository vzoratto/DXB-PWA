<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use app\models\Rol;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property int $dniUsuario
 * @property string $claveUsuario
 * @property string $mailUsuario
 * @property string $authkey
 * @property int $activado
 * @property int $idRol
 *
 * @property Gestores[] $gestores
 * @property Persona[] $personas
 * @property Rol $rol
 */
class Usuario extends \yii\db\ActiveRecord implements IdentityInterface
{

    const ESTADO_INACTIVO=0;
    const ESTADO_ACTIVO=1;
    const ESTADO_MODIFICADO=2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //definicion de campos obligatorios
            [['dniUsuario', 'claveUsuario', 'mailUsuario', 'authkey', 'activado', 'idRol'], 'required','message'=>'Este campo es obligatorio.'],
            //valida que los datos dniUsuario, activado e idRol sean de tipo entero
            [['dniUsuario', 'activado', 'idRol'], 'integer','message'=>'Este valor es incorrecto.'],
           // ['dniUsuario','usuario_existe'],
            //valida que claveUsuario y mailUsuario sean de tipo string con un maximo de 100 caracteres
            [['claveUsuario', 'mailUsuario'], 'string', 'max' => 100],
            //valida que authkey sea del tipo string con maximo de 50 caracteres
            [['authkey'], 'string', 'max' => 50],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'dniUsuario' => 'Dni Usuario',
            'claveUsuario' => 'Clave Usuario',
            'mailUsuario' => 'Mail Usuario',
            'authkey' => 'Authkey',
            'activado' => 'Activado',
            'idRol' => 'Rol',
        ];
    }
    /*public function usuario_existe($attribute, $params)
    {
       //Buscar el username en la tabla
        $table = Usuario::find()->where("dniUsuario=:dniUsuario", [":dniUsuario" => $this->dniUsuario]);
        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
                $this->addError($attribute, "El usuario ingresado existe, verificar los datos.");
         }
    }*/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestores()
    {
        return $this->hasMany(Gestores::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['idRol' => 'idRol']);
    }
    public function getRoles(){
        return $this->idRol->Rol;
      }

      public static function roleInArray($arr_role){
        return in_array(Yii::$app->user->identity->idRol, $arr_role);
      }

      public function getRoldescripcion(){
          $dropciones=Rol::find()->asArray()->all();
          return ArrayHelper::map($dropciones,'idRol','descripcionRol');
      }

    
    public function getUsuario($dni)
    {
        return self::find()
		     ->where(["dniUsuario" => $dni])->one();
		    
    }

    public function getElusuario($d,$c){
        return self::find()
		     ->where(["dniUsuario" => $d])
		    ->andWhere(["authkey" => $c])->one();
      
    }

    public function getAuthKey() {
        return $this->authkey;
    }

    public function getId() {
        return $this->idUsuario;
    }

    public function validateAuthKey($authKey) {
        return $this->authkey === $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

    public static function findByUsername($dni) {
        return self::findOne(["dniUsuario" => $dni]);
    }

    public function validatePassword($password) {
        return $this->claveUsuario ===crypt($password, Yii::$app->params["salt"]);//Encriptamos el password $password;
    }

    public function validateMail($email){
        return $this->mailUsuario === $email;
    }

    
}


