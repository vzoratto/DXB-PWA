<?php

namespace app\models;

use Yii;
<<<<<<< HEAD
//estado del equipo
=======

>>>>>>> parent of 874d7b6... Revert "Merge branch 'lili-ultimo'"
/**
 * This is the model class for table "estadopagoequipo".
 *
 * @property int $idEstadoPago
 * @property int $idEquipo
 *
 * @property Estadopago $estadoPago
 * @property Equipo $equipo
 */
class Estadopagoequipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estadopagoequipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEstadoPago', 'idEquipo'], 'required'],
            [['idEstadoPago', 'idEquipo'], 'integer'],
            [['idEstadoPago', 'idEquipo'], 'unique', 'targetAttribute' => ['idEstadoPago', 'idEquipo']],
            [['idEstadoPago'], 'exist', 'skipOnError' => true, 'targetClass' => Estadopago::className(), 'targetAttribute' => ['idEstadoPago' => 'idEstadoPago']],
            [['idEquipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['idEquipo' => 'idEquipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEstadoPago' => 'Id Estado Pago',
            'idEquipo' => 'Id Equipo',
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
    public function getEquipo()
    {
        return $this->hasOne(Equipo::className(), ['idEquipo' => 'idEquipo']);
    }
}
