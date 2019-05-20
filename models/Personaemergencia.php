<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personaemergencia".
 *
 * @property int $idPersonaEmergencia
 * @property string $nombrePersonaEmergencia
 * @property string $apellidoPersonaEmergencia
 * @property string $telefonoPersonaEmergencia
 * @property int $idVinculoPersonaEmergencia
 *
 * @property Persona[] $personas
 * @property Vinculopersona $vinculoPersonaEmergencia
 */
class Personaemergencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personaemergencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idVinculoPersonaEmergencia'], 'integer'],
            [['nombrePersonaEmergencia', 'apellidoPersonaEmergencia'], 'string', 'max' => 64],
            [['telefonoPersonaEmergencia'], 'string', 'max' => 32],
            [['idVinculoPersonaEmergencia'], 'exist', 'skipOnError' => true, 'targetClass' => Vinculopersona::className(), 'targetAttribute' => ['idVinculoPersonaEmergencia' => 'idVinculo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPersonaEmergencia' => 'Id Persona Emergencia',
            'nombrePersonaEmergencia' => 'Nombre  Emergencia',
            'apellidoPersonaEmergencia' => 'Apellido  Emergencia',
            'telefonoPersonaEmergencia' => 'Telefono Emergencia',
            'idVinculoPersonaEmergencia' => 'Id Vinculo Persona Emergencia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idPersonaEmergencia' => 'idPersonaEmergencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVinculoPersonaEmergencia()
    {
        return $this->hasOne(Vinculopersona::className(), ['idVinculo' => 'idVinculoPersonaEmergencia']);
    }
}
