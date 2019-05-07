<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property int $idRol
 * @property string $descripcionRol
 *
 * @property Usuariorol[] $usuariorols
 * @property Usuario[] $usuarios
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRol'], 'required'],
            [['idRol'], 'integer'],
            [['descripcionRol'], 'string', 'max' => 64],
            [['idRol'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRol' => 'Id Rol',
            'descripcionRol' => 'Descripcion Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariorols()
    {
        return $this->hasMany(Usuariorol::className(), ['idRol' => 'idRol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idUsuario' => 'idUsuario'])->viaTable('usuariorol', ['idRol' => 'idRol']);
    }
}
