<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipocarrera".
 *
 * @property int $idTipoCarrera
 * @property string $descripcionCarrera
 * @property string $reglamento
 * @property int $deshabilitado
 * @property int $cantidadMaximaCorredores
 *
 * @property Carrerapersona[] $carrerapersonas
 * @property Persona[] $personas
 * @property Equipo[] $equipos
 */
class Tipocarrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipocarrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deshabilitado', 'cantidadMaximaCorredores'], 'integer'],
            [['descripcionCarrera'], 'string', 'max' => 64],
            [['reglamento'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipoCarrera' => 'Id Tipo Carrera',
            'descripcionCarrera' => 'Descripcion Carrera',
            'reglamento' => 'Reglamento',
            'deshabilitado' => 'Deshabilitado',
            'cantidadMaximaCorredores' => 'Cantidad Maxima Corredores',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrerapersonas()
    {
        return $this->hasMany(Carrerapersona::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idPersona' => 'idPersona'])->viaTable('carrerapersona', ['idTipoCarrera' => 'idTipoCarrera']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasMany(Equipo::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }
}
