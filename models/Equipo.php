<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Persona;

/**
 * This is the model class for table "equipo".
 *
 * @property int $idEquipo
 * @property string $nombreEquipo
 * @property int $cantidadPersonas
 * @property int $idTipoCarrera
 * @property int $deshabilitado
 *
 * @property Tipocarrera $tipoCarrera
 * @property Grupo[] $grupos
 * @property Persona[] $personas
 * @property Estadopagoequipo[] $estadopagoequipo
 * @property Estadopago[] $
 * @property Pago[] $pago
 */
class Equipo extends \yii\db\ActiveRecord
{
    public $estadopago;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidadPersonas', 'idTipoCarrera', 'deshabilitado'], 'integer'],
            [['idTipoCarrera'], 'required'],
            [['nombreEquipo'], 'string', 'max' => 64],
            [['idTipoCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Tipocarrera::className(), 'targetAttribute' => ['idTipoCarrera' => 'idTipoCarrera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEquipo' => 'Id Equipo',
            'nombreEquipo' => 'Nombre Equipo',
            'cantidadPersonas' => 'Cantidad Personas',
            'idTipoCarrera' => 'Id Tipo Carrera',
            'deshabilitado' => 'Deshabilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCarrera()
    {
        return $this->hasOne(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['idEquipo' => 'idEquipo']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['dniUsuario' => 'dniCapitan']);
    }
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasMany(Grupo::className(), ['idEquipo' => 'idEquipo']);
    }
/**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadopagoequipo()
    {
        return $this->hasMany(Estadopagoequipo::className(), ['idEquipo' => 'idEquipo']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadopago()
    {
        return $this->hasMany(Estadopago::className(), ['idEstadoPago' => 'idEstadoPago'])->viaTable('estadopagoequipo', ['idEquipo' => 'idEquipo']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasMany(Persona::className(), ['idPersona' => 'idPersona'])->viaTable('grupo', ['idEquipo' => 'idEquipo']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
     public function listaCap(){
        $lista= ArrayHelper::map(\app\models\Equipo::find()
              ->select('idEquipo,dniCapitan,')
              ->all(),'idEquipo','dniCapitan');

        return $lista;

     }
 /**
     * @return \yii\db\ActiveQuery
     */
    public function listaUsu(){
     $lista= ArrayHelper::map(\app\models\Equipo::find()
        ->select('(grupo.idEquipo) as grupo,equipo.cantidadPersonas,equipo.dniCapitan,')
        ->innerJoin('grupo','equipo.idEquipo=grupo.idEquipo')
        ->groupBy(['equipo.idEquipo'])
        ->all(),'idEquipo','dniCapitan');
        return $lista;
    }

    //comprueba si el equipo/capitan es invitado
    public function invitado(){
        $invitado=false;
        //capitan del equipo
        //$personaCap=Persona::findOne(['dniCapitan'=>$this->dniCapitan]);
        $usuario=Usuario::findOne(['dniUsuario'=>$this->dniCapitan]);
        //si el capitan es invitado
        if($usuario->idRol==4){
            $invitado=true;

        }
        return $invitado;


    }
}
