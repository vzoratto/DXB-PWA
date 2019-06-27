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
 * @property int $idUsuario
 *
 * @property Pago $pago
 * @property Usuario $usuario
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
            [['idPago'], 'required'],
            [['idPago', 'idUsuario'], 'integer'],
            [['fechaPago', 'fechachequeado'], 'safe'],
            [['idPago'], 'exist', 'skipOnError' => true, 'targetClass' => Pago::className(), 'targetAttribute' => ['idPago' => 'idPago']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idControlpago' => 'Id Controlpago',
            'idPago' => 'Id Pago',
            'fechaPago' => 'Fecha Pago',
            'fechachequeado' => 'Fechachequeado',
            'idUsuario' => 'Id Usuario',
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
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }

    public function getDarusuario(){
        if($fecha=self::find()->where(['fechachequeado'=>'0000-00-00'])->all()){
         return $fecha;
        }
        
    }
}
