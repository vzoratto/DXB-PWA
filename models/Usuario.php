<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property int $dniUsuario
 * @property string $claveUsuario
 * @property string $mailUsuario
 * @property int $idRol
 *
 * @property Gestores[] $gestores
 * @property Persona[] $personas
 * @property Rol $rol
 * @property Validacion[] $validacions
 */
class Usuario extends \yii\db\ActiveRecord
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
            [['dniUsuario', 'claveUsuario', 'mailUsuario', 'idRol'], 'required'],
            [['dniUsuario', 'idRol'], 'integer'],
            [['claveUsuario', 'mailUsuario'], 'string', 'max' => 100],
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
            'idRol' => 'Id Rol',
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
    public function getValidacions()
    {
        return $this->hasMany(Validacion::className(), ['idUsuario' => 'idUsuario']);
    }
}
