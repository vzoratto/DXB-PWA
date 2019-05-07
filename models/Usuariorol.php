<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuariorol".
 *
 * @property int $idRol
 * @property int $idUsuario
 *
 * @property Rol $rol
 * @property Usuario $usuario
 */
class Usuariorol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuariorol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRol', 'idUsuario'], 'required'],
            [['idRol', 'idUsuario'], 'integer'],
            [['idRol', 'idUsuario'], 'unique', 'targetAttribute' => ['idRol', 'idUsuario']],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idRol' => 'idRol']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRol' => 'Id Rol',
            'idUsuario' => 'Id Usuario',
        ];
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
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
