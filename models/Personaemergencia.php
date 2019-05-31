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
            //campos requeridos
            [['nombrePersonaEmergencia','apellidoPersonaEmergencia','telefonoPersonaEmergencia','idVinculoPersonaEmergencia'],'required','message'=>'Campo obligatorio'],
            [['idVinculoPersonaEmergencia'], 'integer'],
            //solo string para el campo nombre y apellido
            [['nombrePersonaEmergencia','apellidoPersonaEmergencia'],'match','pattern'=>'/^[a-zA-Z.,-]+(?:\s[a-zA-Z.,-]+)*$/'],
            [['nombrePersonaEmergencia', 'apellidoPersonaEmergencia'], 'string', 'max' => 64,'message'=>'formato inválido'],
            [['nombrePersonaEmergencia', 'apellidoPersonaEmergencia'], 'string', 'min' => 3,'message'=>'formato inválido'],
            [['telefonoPersonaEmergencia'], 'string', 'max' => 32],
            [['telefonoPersonaEmergencia'], 'string', 'min' => 4],
            //el telefono debe ser solo digitos numericos
            //el telefono admite codigo internacional +54 por ej argentina
            [['telefonoPersonaEmergencia'], 'match', 'pattern' => '/^\+?([0-9])*$/','message'=>'El formato inválido'],
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
