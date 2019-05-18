<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "validacion".
 *
 * @property int $idValidacion
 * @property int $idUsuario
 * @property int $mailUsuarioValidado
 * @property string $codigoValidacionMail
 * @property string $codigoRecuperarCuenta
 *
 * @property Usuario $usuario
 */
class Validacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'validacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario'], 'required'],
            [['idUsuario', 'mailUsuarioValidado'], 'integer'],
            [['codigoValidacionMail', 'codigoRecuperarCuenta'], 'string', 'max' => 16],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idValidacion' => 'Id Validacion',
            'idUsuario' => 'Id Usuario',
            'mailUsuarioValidado' => 'Mail Usuario Validado',
            'codigoValidacionMail' => 'Codigo Validacion Mail',
            'codigoRecuperarCuenta' => 'Codigo Recuperar Cuenta',
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
