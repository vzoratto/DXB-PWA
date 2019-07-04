<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
/**
 * This is the model class for table "pago".
 *
 * @property int $idPago
 * @property int $importePagado
 * @property string $entidadPago
 * @property string $imagenComprobante
 * @property int $idPersona
 * @property int $idImporte
 * @property int $idEquipo
 *
 * @property Controlpago[] $controlpagos
 * @property Persona $persona
 * @property Importeinscripcion $importe
 * @property Equipo $equipo
 */
class Pago extends \yii\db\ActiveRecord
{
    public $dniUsu;
    public $chequeado;
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
            [['importePagado', 'entidadPago', 'imagenComprobante', 'idPersona', 'idImporte'], 'required'],
            [['importePagado', 'idPersona', 'idImporte', 'idEquipo','dniUsu','chequeado'], 'integer'],
            [['entidadPago'], 'string', 'max' => 64],
            [['imagenComprobante'], 'file','extensions' => 'jpg, jpeg, png, bmp, jpe'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
            [['idImporte'], 'exist', 'skipOnError' => true, 'targetClass' => Importeinscripcion::className(), 'targetAttribute' => ['idImporte' => 'idImporte']],
            [['idEquipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['idEquipo' => 'idEquipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPago' => 'Id Pago',
            'dniUsu'=> 'DNI participante',
            'importePagado' => 'Importe Pagado',
            'entidadPago' => 'Entidad Pago',
            'chequeado'=>'Chequeado',
            'imagenComprobante' => 'Imagen Comprobante',
            'idPersona' => 'Persona',
            'idImporte' => 'Importe',
            'idEquipo' => 'Equipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlpagos()
    {
        return $this->hasMany(Controlpago::className(), ['idPago' => 'idPago']);
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

    public function sumaEquipo($idEquipo){
        $query = (new Query())->select('SUM(importePagado) as suma')
                              ->from('pago')
                              ->where(['idEquipo' =>$idEquipo]);
         return $query->suma;
    }

    
}
