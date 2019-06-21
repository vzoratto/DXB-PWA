<?php

namespace app\models;

use Yii;
use app\models\Persona;

/**
 * This is the model class for table "fichamedica".
 *
 * @property int $idFichaMedica
 * @property string $obraSocial
 * @property double $peso
 * @property double $altura
 * @property int $frecuenciaCardiaca
 * @property int $idGrupoSanguineo
 * @property int $evaluacionMedica
 * @property int $intervencionQuirurgica
 * @property int $tomaMedicamentos
 * @property int $suplementos
 * @property string $observaciones
 *
 * @property Gruposanguineo $grupoSanguineo
 * @property Persona[] $personas
 */
class Fichamedica extends \yii\db\ActiveRecord
{
	public $apellidoPersona;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fichamedica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // Se declaran todos los campos obligatorios
            [['peso','altura','frecuenciaCardiaca', 'evaluacionMedica', 'intervencionQuirurgica', 'tomaMedicamentos','suplementos','obraSocial','idGrupoSanguineo'], 'required','message' => 'Este campo es obligatorio.'],
            // Se valida que frecuencia cardiaca acepte solo caracteres numericos
            [['frecuenciaCardiaca'],'match','pattern'=>"/^[0-9]*$/",'message'=>"Unicamente se aceptan caracteres numericos"],
            // Valida que los siguientes campos sean booleanos
            [['evaluacionMedica','intervencionQuirurgica','tomaMedicamentos','suplementos'], 'boolean'],
            // Valida que obra social esté compuesto por caracteres alfanumericos
            [['obraSocial'],'match','pattern'=>"/^[a-zA-Z0-9\s]+$/",'message'=>"Unicamente se aceptan caracteres alfanumericos"],
            // Valida que haya elegido algun grupo sanguineo
            [['idGrupoSanguineo'], 'exist', 'skipOnError' => true, 'targetClass' => Gruposanguineo::className(), 'targetAttribute' => ['idGrupoSanguineo' => 'idGrupoSanguineo']],
            // Valida que peso y altura sean solo numeros. Pueden estar separados por '.' o ','
            [['altura'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['peso'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            
           [['apellidoPersona','grupoSanguineo','donador'],'safe'] ,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFichaMedica' => 'Id Ficha Medica',
            'obraSocial' => 'Obra Social',
            'peso' => 'Peso',
            'altura' => 'Altura',
            'frecuenciaCardiaca' => 'Frecuencia Cardiaca',
            'idGrupoSanguineo' => 'Id Grupo Sanguineo',
            'evaluacionMedica' => 'Evaluacion Medica',
            'intervencionQuirurgica' => 'Intervencion Quirurgica',
            'tomaMedicamentos' => 'Toma Medicamentos',
            'suplementos' => 'Suplementos',
            'observaciones' => 'Observaciones',
			
			'apellidoPersona'=>'apellidoPersona',
			'grupoSanguineo'=>'grupoSanguineo',
			'donador'=>'donador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoSanguineo()
    {
        return $this->hasOne(Gruposanguineo::className(), ['idGrupoSanguineo' => 'idGrupoSanguineo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idFichaMedica' => 'idFichaMedica']);
    }
	
	
}

