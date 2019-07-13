<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "controlpago".
 *
 * @property int $idControlpago
 * @property int $idPago
 * @property string $fechaPago
 * @property string $fechachequeado
 * @property int $chequeado
 * @property int $idGestor
 *
 * @property Pago $pago
 * @property Gestores $gestor
 */
class Controlpago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'controlpago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPago', 'chequeado'], 'required'],
            [['idPago', 'chequeado', 'idGestor'], 'integer'],
            [['fechaPago', 'fechachequeado'], 'safe'],
            [['idPago'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::className(), 'targetAttribute' => ['idPago' => 'idPago']],
            [['idGestor'], 'exist', 'skipOnError' => true, 'targetClass' => Gestores::className(), 'targetAttribute' => ['idGestor' => 'idGestor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idControlpago' => 'Referencia pago',
            'idPago' => ' Pago',
            'fechaPago' => 'Fecha pago',
            'fechachequeado' => 'Fecha chequeado',
            'chequeado' => 'Chequeado',
            'idGestor' => 'Gestor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPago()
    {
        return $this->hasOne(Pago::className(), ['idPago' => 'idPago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGestor()
    {
        return $this->hasOne(Gestores::className(), ['idGestor' => 'idGestor']);
    }
}
