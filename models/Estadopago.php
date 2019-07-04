<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadopago".
 *
 * @property int $idEstadoPago
 * @property string $descripcionEstadoPago
 *
 * @property Estadopagoequipo[] $estadopagoequipos
 * @property Equipo[] $equipos
 */
class Estadopago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadopago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcionEstadoPago'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEstadoPago' => 'Id Estado Pago',
            'descripcionEstadoPago' => 'Descripcion Estado Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadopagoequipos()
    {
        return $this->hasMany(Estadopagoequipo::className(), ['idEstadoPago' => 'idEstadoPago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['idEquipo' => 'idEquipo'])->viaTable('estadopagoequipo', ['idEstadoPago' => 'idEstadoPago']);
    }
}
