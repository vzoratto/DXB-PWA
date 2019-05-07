<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadopago".
 *
 * @property int $idEstadoPago
 * @property string $descripcionEstadoPago
 *
 * @property Persona[] $personas
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
            [['idEstadoPago'], 'required'],
            [['idEstadoPago'], 'integer'],
            [['descripcionEstadoPago'], 'string', 'max' => 64],
            [['idEstadoPago'], 'unique'],
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
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idEstadoPago' => 'idEstadoPago']);
    }
}
