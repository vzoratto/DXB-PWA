<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipocarrera".
 *
 * @property int $idTipoCarrera
 * @property string $descripcionCarrera
 * @property int $deshabilitado
 *
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
            [['deshabilitado'], 'integer'],
            [['descripcionCarrera'], 'string', 'max' => 64],
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
            'deshabilitado' => 'Deshabilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }
}
