<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gestores".
 *
 * @property int $idGestor
 * @property string $nombreGestor
 * @property string $apellidoGestor
 * @property string $telefonoGestor
 * @property int $idUsuario
 *
 * @property Usuario $usuario
 */
class Gestores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario'], 'required'],
            [['idUsuario'], 'integer'],
            [['nombreGestor', 'apellidoGestor'], 'string', 'max' => 64],
            [['telefonoGestor'], 'string', 'max' => 32],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGestor' => 'Id Gestor',
            'nombreGestor' => 'Nombre Gestor',
            'apellidoGestor' => 'Apellido Gestor',
            'telefonoGestor' => 'Telefono Gestor',
            'idUsuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
