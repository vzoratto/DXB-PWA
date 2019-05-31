<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
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
            [['dniUsuario', 'claveUsuario', 'mailUsuario', 'authkey', 'activado', 'idRol'], 'required'],
            [['dniUsuario', 'activado', 'idRol'], 'integer'],
            [['claveUsuario', 'mailUsuario'], 'string', 'max' => 100],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario($dni)
    {
        return $this->hasOne(Usuario::className(), ['dniUsuario' => $dni]);
    }

    public function getElusuario($d,$c)
    {
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
        return $this->claveUsuario === $password;
    }


}


