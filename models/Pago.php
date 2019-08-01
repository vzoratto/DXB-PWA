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
    public $nombre;
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
            [['imagenComprobante'], 'file',
                'maxSize' => 20 * 1024 * 1024, //10MB
                'tooBig' => 'El tamaño máximo permitido es 10MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'jpg, jpeg, png, bmp, jpe',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
            ],
           // [['imagenComprobante'], 'file','extensions' => 'jpg, jpeg, png, bmp, jpe'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
            [['idImporte'], 'exist', 'skipOnError' => true, 'targetClass' => Importeinscripcion::className(), 'targetAttribute' => ['idImporte' => 'idImporte']],
            [['idEquipo'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['idEquipo' => 'idEquipo']],
           //lo verificamos como dao seguro
           [['dniUsu','chequeado'],'safe'],
        ];
    }

    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPago' => 'Referencia pago',
            'dniUsu'=> 'DNI participante',
            'importePagado' => 'Importe Pagado',
            'entidadPago' => 'Entidad Pago',
            'chequeado'=>'Chequeado',
            'imagenComprobante' => 'Imagen Comprobante',
            'idPersona' => 'Nombre corredor',
            'nombre'=>'Nombre corredor',
            'idImporte' => 'Importe',
            'idEquipo' => 'Equipo',
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
     * Busca los equipo por condicion del estado pago todos los corredores
     * para visualizar link pago inscripcion de la barra de navegacion
     * @return \yii\db\ActiveQuery
     */
    public function buscaequipo1(){
        $suma='';
        $estadopago=0;//0 para los equipos que no pagaron
        if(!Yii::$app->user->isGuest){
            $persona=Persona::findOne(['idUsuario'=>$_SESSION['__id']]);
            if($persona != null ){
                $grupo=Grupo::findOne(['idPersona'=>$persona->idPersona]);
                if($grupo!=null){
                    $suma=Pago::sumaTotalequipo($grupo->idEquipo);
                    $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);
                    $importe=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                    $estadoequipo=Estadopagoequipo::findOne(['idEquipo'=>$grupo->idEquipo]);
                    if($estadoequipo!=NULL ){
                        if($estadoequipo->idEstadoPago==2){//se consulta el estado pago parcial
                            if($importe->importe > $suma){
                                $estadopago=2; //2 para los equipos con pago 
                            }elseif($importe->importe == $suma){
                                $estadopago=3; //si tiene todo pagado pero falta chequear el
                            }                  //ultimo pago parcial
                        }else{
                            $estadopago=3;//3 para los equipos pago total o cancelo
                        }
                    }else{
                        if($importe->importe == $suma){//cuando pago todo sin check
                            $estadopago=3;
                        }
                    }
                }//si no pertenece a un grupo lista de espera??
            }else{
                $estadopago=3;//3 para el usuario sin inscripcion
            }
        }
        return $estadopago;//para visualizar o no en la barra de la pagina
    }
/**
     * Busca los equipo por condicion del estado pago solo dniCapitan
     *  para visualizar link pago inscripcion de la barra de navegacion
     * @return \yii\db\ActiveQuery
     */
    public function buscaequipo(){
        //estadopago=3 no se ve el link
        $estadopago=0;//0 para los equipos que no pagaron
        if(!Yii::$app->user->isGuest){
            if($persona=Persona::findOne(['idUsuario'=>$_SESSION['__id']])){
                $espera=Listadeespera::findOne(['idPersona'=>$persona->idPersona]);
                if($espera==null){
                    $usuario=Usuario::findOne(['idUsuario'=>$persona->idUsuario]);
                    $equipo=Equipo::findOne(['dniCapitan'=>$usuario->dniUsuario]);//para que el pago lo realice el capitan
                   if($equipo!=null){
                       $suma=Pago::sumaTotalequipo($equipo->idEquipo);
                       $importe=Importeinscripcion::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
                       $estadoequipo=Estadopagoequipo::findOne(['idEquipo'=>$equipo->idEquipo]);
                       if($estadoequipo!=null ){
                           if($estadoequipo->idEstadoPago==2){//se consulta el estado pago parcial
                               if($importe->importe > $suma){
                                   $estadopago=2; //2 para los equipos con pago parcial
                               }elseif($importe->importe == $suma){
                                   $estadopago=3; //si tiene todo pagado pero falta chequear el
                               }                  //ultimo pago parcial
                           }else{
                               $estadopago=3;//3 para los equipos pago total o cancelo
                           }
                       }else{
                           if($importe->importe == $suma){//cuando pago todo sin check
                               $estadopago=3;
                           }
                        }
                  }else{
                      $estadopago=3;//para el corredor que no es capitan
                  }
             }else{
                   $estadopago=3;//para el capitan en lista de espera
                 }
            }else{
                $estadopago=3;//3 para el usuario sin inscripcion
            }
        }
        return $estadopago;//para visualizar o no en la barra de la pagina
    }

}
