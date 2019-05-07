<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property int $cuilUsuario
 * @property string $claveUsuario
 *
 * @property Persona[] $personas
 * @property Usuariorol[] $usuariorols
 * @property Rol[] $rols
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
            [['cuilUsuario', 'claveUsuario'], 'required'],
            [['cuilUsuario'], 'integer'],
            [['claveUsuario'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'cuilUsuario' => 'Cuil Usuario',
            'claveUsuario' => 'Clave Usuario',
        ];
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
    public function getUsuariorols()
    {
        return $this->hasMany(Usuariorol::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRols()
    {
        return $this->hasMany(Rol::className(), ['idRol' => 'idRol'])->viaTable('usuariorol', ['idUsuario' => 'idUsuario']);
    }
}
