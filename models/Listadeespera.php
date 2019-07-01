<?php

namespace app\models;

use Yii;
use app\models\Persona;
use app\models\Tipocarrera;

/**
 * This is the model class for table "listadeespera".
 *
 * @property int $idListaDeEspera
 * @property int $idPersona
 *
 * @property Persona $persona
 */
class Listadeespera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listadeespera';
    }

    /**
     * {@inheritdoc}
     */
    public $edad;

    public function rules()
    {
        return [
            [['idPersona'], 'required'],
            [['idPersona'], 'integer'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']], 
             [['edad'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idListaDeEspera' => 'Id Lista De Espera',
            'idPersona' => 'Id Persona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }

    public function getCarrerapersona()
    {
        return $this->hasOne(Carrerapersona::className(), ['idTipoCarrera' => 'idTipoCarrera'])->viaTable ('tipoCarrera',['idTipoCarrera'=>'idTipoCarrera']);
    }
    public function getEquipo()
    {
       // return $this->hasOne(Equipo::className(), ['idTipoCarrera' => 'idTipoCarrera']);
        return $this->hasOne(Equipo::className(),['idEquipo'=> 'idEquipo'])->viaTable ('grupo',['idPersona'=>'idPersona']);
  
    }
    public function getTipoCarrera()
    {
        //return $this->hasOne(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera']);
        return $this->hasOne(Tipocarrera::className(),['idTipoCarrera'=> 'idTipoCarrera'])->viaTable ('carrerapersona',['idPersona'=>'idPersona']);
    }


    public function afterFind() {
        parent::afterFind();
        // Calculo y asigno la edad en años en el nuevo atributo virtual
        $nacimiento = new \DateTime($this->persona->fechaNacPersona);
        $hoy = new \DateTime();
        $edad = $hoy->diff($nacimiento);
        $this->edad = $edad->y; // Se puede usar también $edad->m (meses), $edad->d (días), etc.
    }

}
