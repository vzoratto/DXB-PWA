<?php

namespace app\models;

use Yii;

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
 */
class Equipo extends \yii\db\ActiveRecord
{
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
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['idEquipo' => 'idEquipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idPersona' => 'idPersona'])->viaTable('grupo', ['idEquipo' => 'idEquipo']);
    }
}
