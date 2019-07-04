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
            [['importePagado', 'idPersona', 'idImporte', 'idEquipo'], 'integer'],
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
            'importePagado' => 'Importe Pagado',
            'entidadPago' => 'Entidad Pago',
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

    public function buscaequipo(){
        
        $estadopago=0;//0 para los equipos que no pagaron
        if(!Yii::$app->user->isGuest){
        $persona=Persona::findOne(['idUsuario'=>$_SESSION['__id']]);
        $grupo=Grupo::findOne(['idPersona'=>$persona->idPersona]);
        if($grupo!=null){
          $estadoequipo=Estadopagoequipo::findOne(['idEquipo'=>$grupo->idEquipo]);
            if($estadoequipo!=null ){
               if($estadoequipo->idEstadoPago==2){
                   $estadopago=2; //2 para los equipos con pago parcial
              }else{
                $estadopago=3;//3 para los equipos pago total o cancelo
              }
            }   
          }
        }
        return $estadopago;
    }
}
