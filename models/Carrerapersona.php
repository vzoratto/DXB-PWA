<?php

namespace app\models;

use Yii;
use app\models\Persona;

use app\models\Equipo;
use app\models\Tipocarrera;

/**
 * This is the model class for table "carrerapersona".
 *
 * @property int $idTipoCarrera
 * @property int $idPersona
 * @property int $reglamentoAceptado
 * @property int $retiraKit
 *
 * @property Persona $persona
 * @property Tipocarrera $tipoCarrera
 */
class Carrerapersona extends \yii\db\ActiveRecord    
{
	//creamos atributos virtuales
	public $apellidoPersona;
	public $nombrePersona;
	public $dniUsuario;
	public $talleRemera;
	public $nombreEquipo;
	public $categoria;
	public $nombre_completo;
	public $edad;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrerapersona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTipoCarrera', 'idPersona','reglamentoAceptado'], 'required'],
            ['reglamentoAceptado','compare','compareValue'=>1,'message'=>'Debe aceptar el reglamento para inscribirse a la carrera'],
            [['idTipoCarrera', 'idPersona', 'reglamentoAceptado', 'retiraKit'], 'integer'],
            [['idTipoCarrera', 'idPersona'], 'unique', 'targetAttribute' => ['idTipoCarrera', 'idPersona']],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
            [['idTipoCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Tipocarrera::className(), 'targetAttribute' => ['idTipoCarrera' => 'idTipoCarrera']],
            //los asignamos como safe.
			[['apellidoPersona','nombrePersona','talleRemera','nombreEquipo','categoria','nombre_completo','edad'], 'safe'],
			
	   ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipoCarrera' => 'Tipo Carrera',
            'idPersona' => 'Id Persona',
            'reglamentoAceptado' => 'Reglamento Aceptado',
            'retiraKit' => 'Retira Kit',
			'apellidoPersona'=>'apellidoPersona' ,
			'edad'=>'edad',
        ];
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
    public function getTipoCarrera()
    {
        return $this->hasOne(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }
	public function getEquipo()
    {
       // return $this->hasOne(Equipo::className(), ['idTipoCarrera' => 'idTipoCarrera']);
        return $this->hasOne(Equipo::className(),['idEquipo'=> 'idEquipo'])->viaTable ('grupo',['idPersona'=>'idPersona']);
  
    }
   
    public function getTalleRemera(){
	   return $this->hasOne(Persona::className(),['idTalleRemera'=> 'idTalleRemera'])->viaTable (TalleRemera::className(),['idTalleRemera'=>'idTalleRemera']);
    }
	public function afterFind() {
        parent::afterFind();
        // Concateno el nombre y apellido en el nuevo atributo virtual
        $this->nombre_completo = "{$this->persona->apellidoPersona} {$this->persona->nombrePersona}";
        // Calculo y asigno la edad en años en el nuevo atributo virtual
        $nacimiento = new \DateTime($this->persona->fechaNacPersona);
        $hoy = new \DateTime();
        $edad = $hoy->diff($nacimiento);
        $this->edad = $edad->y; // Se puede usar también $edad->m (meses), $edad->d (días), etc.
    }
	
}
