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
            [['importePagado', 'idPersona', 'idImporte', 'idEquipo'], 'integer'],
            [['entidadPago'], 'string', 'max' => 64],
            [['dniUsu','chequeado'],'safe'],
            [['imagenComprobante'], 'file','extensions' => 'jpg, jpeg, png, bmp, jpe'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
            [['idImporte'], 'exist', 'skipOnError' => true, 'targetClass' => Importeinscripcion::className(), 'targetAttribute' => ['idImporte' => 'idImporte']],
            [['idEquipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['idEquipo' => 'idEquipo']],
        ];
    }

    // Este método se invoca después de usarse Pago::find()
    // Aquí se pueden establecer valores para los atributos virtuales
    public function afterFind() {
        parent::afterFind();
        // Buscamos chequeado en el nuevo atributo virtual
        $this->chequeado = ($this->controlpagos);
        $this->dniUsu="{$this->persona->usuario->dniUsuario}";
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
    public function getPersonausu()
    {
        return $this->hasOne(Persona::className(), ['idUsuario' => 'idUsuario'])->viaTable(Usuario::className(),['idUsuario' => 'idUsuario']);
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
      * Suma todos los pagos realizados y chequeados
     * @return \yii\db\ActiveQuery
     */
    public function sumaEquipo($idEquipo){
        $query = Pago::find()
              ->select(['SUM(importePagado) as suma'])
              ->leftjoin('controlpago c','c.idPago=pago.idPago')
              ->where(['idEquipo'=>$idEquipo ,'c.chequeado'=>1])
              ->asArray()->one();
         return $query['suma'];
    }
    /**
      * Suma todos los pagos realizados
     * @return \yii\db\ActiveQuery
     */
    public function sumaTotalequipo($idEquipo){
        $query = Pago::find()
              ->select(['SUM(importePagado) as suma'])
              ->leftjoin('controlpago c','c.idPago=pago.idPago')
              ->where(['idEquipo'=>$idEquipo ])
              ->asArray()->one();
         return $query['suma'];
    }
     /**
      * Busca los equipo por condicion del estado pago
     * @return \yii\db\ActiveQuery
     */
    public function buscaequipo(){ 
        $estadopago=0;//0 para los equipos que no pagaron
        if(!Yii::$app->user->isGuest){
        $persona=Persona::findOne(['idUsuario'=>$_SESSION['__id']]);
        $grupo=Grupo::findOne(['idPersona'=>$persona->idPersona]);
        if($grupo!=null){
          $estadoequipo=Estadopagoequipo::findOne(['idEquipo'=>$grupo->idEquipo]);
            if($estadoequipo!=null ){
               if($estadoequipo->idEstadoPago==2){//se consulta el estado pago parcial
                   $suma=Pago::sumaTotalequipo($grupo->idEquipo);
                   $pago=Pago::findOne(['idEquipo'=>$grupo->idEquipo]);
                   $importe=Importeinscripcion::findOne(['idImporte'=>$pago->idImporte]);
                   if($importe->importe > $suma){
                        $estadopago=2; //2 para los equipos con pago parcial
                   }elseif($importe->importe == $suma){
                       $estadopago=3; //si tiene todo pagado pero falta chequear el 
                   }                  //ultimo pago parcial
              }else{
                $estadopago=3;//3 para los equipos pago total o cancelo
              }               
            }                 
          }
        }
        return $estadopago;//para visualizar en la barra de la pagina
    }
}
