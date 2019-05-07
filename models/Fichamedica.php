<?php

namespace app\models;

use Yii;

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
            [['peso', 'altura'], 'number'],
            [['frecuenciaCardiaca', 'idGrupoSanguineo', 'evaluacionMedica', 'intervencionQuirurgica', 'tomaMedicamentos', 'suplementos'], 'integer'],
            [['obraSocial'], 'string', 'max' => 32],
            [['observaciones'], 'string', 'max' => 256],
            [['idGrupoSanguineo'], 'exist', 'skipOnError' => true, 'targetClass' => Gruposanguineo::className(), 'targetAttribute' => ['idGrupoSanguineo' => 'idGrupoSanguineo']],
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
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idFichaMedica' => 'idFichaMedica']);
    }
}
