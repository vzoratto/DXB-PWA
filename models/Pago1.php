<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property int $idPago
 * @property int $importePagado
 * @property string $entidadPago
 * @property string $imagenComprobante
 * @property string $fechaPago
 * @property string $fechachequeado
 * @property int $idPersona
 * @property int $idImporte
 * @property int $idEquipo
 * @property int $idUsuario
 *
 * @property Persona $persona
 * @property Importeinscripcion $importe
 * @property Equipo $equipo
 * @property Usuario $usuario
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['importePagado', 'entidadPago', 'imagenComprobante', 'idPersona', 'idImporte', 'idUsuario'], 'required'],
            [['importePagado', 'idPersona', 'idImporte', 'idEquipo', 'idUsuario'], 'integer'],
            [['fechaPago', 'fechachequeado'], 'safe'],
            [['entidadPago'], 'string', 'max' => 64],
            [['imagenComprobante'], 'file','extensions' => 'jpg, jpeg, png, bmp, jpe'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
            [['idImporte'], 'exist', 'skipOnError' => true, 'targetClass' => Importeinscripcion::className(), 'targetAttribute' => ['idImporte' => 'idImporte']],
            [['idEquipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['idEquipo' => 'idEquipo']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPago' => 'Id Pago',
            'importePagado' => 'Importe Pagado',
            'entidadPago' => 'Entidad Pago',
            'imagenComprobante' => 'Imagen Comprobante',
            'fechaPago' => 'Fecha Pago',
            'fechachequeado' => 'Fecha chequeado',
            'idPersona' =>  'Persona',
            'idImporte' => 'Importe',
            'idEquipo' => 'Equipo',
            'idUsuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImporte()
    {
        return $this->hasOne(Importeinscripcion::className(), ['idImporte' => 'idImporte']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::className(), ['idEquipo' => 'idEquipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
}
