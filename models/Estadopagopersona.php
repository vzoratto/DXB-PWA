<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadopagopersona".
 *
 * @property int $idEstadoPago
 * @property int $idPersona
 * @property string $fechaPago
 *
 * @property Estadopago $estadoPago
 * @property Persona $persona
 */
class Estadopagopersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadopagopersona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstadoPago', 'idPersona'], 'required'],
            [['idEstadoPago', 'idPersona'], 'integer'],
            [['fechaPago'], 'safe'],
            [['idEstadoPago', 'idPersona'], 'unique', 'targetAttribute' => ['idEstadoPago', 'idPersona']],
            [['idEstadoPago'], 'exist', 'skipOnError' => true, 'targetClass' => Estadopago::className(), 'targetAttribute' => ['idEstadoPago' => 'idEstadoPago']],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEstadoPago' => 'Id Estado Pago',
            'idPersona' => 'Id Persona',
            'fechaPago' => 'Fecha Pago',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPago()
    {
        return $this->hasOne(Estadopago::className(), ['idEstadoPago' => 'idEstadoPago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }
}
