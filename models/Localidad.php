<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidad".
 *
 * @property int $idLocalidad
 * @property int $idProvincia
 * @property string $nombreLocalidad
 * @property int $codigoPostal
 *
 * @property Provincia $provincia
 * @property Personadireccion[] $personadireccions
 */
class Localidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProvincia', 'nombreLocalidad', 'codigoPostal'], 'required'],
            [['idProvincia', 'codigoPostal'], 'integer'],
            [['nombreLocalidad'], 'string', 'max' => 50],
            [['idProvincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idProvincia' => 'idProvincia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idLocalidad' => 'Id Localidad',
            'idProvincia' => 'Id Provincia',
            'nombreLocalidad' => 'Nombre Localidad',
            'codigoPostal' => 'Codigo Postal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['idProvincia' => 'idProvincia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonadireccions()
    {
        return $this->hasMany(Personadireccion::className(), ['idLocalidad' => 'idLocalidad']);
    }

    /**
     * Funcion que devuelve una lista de las localidad con el idProvincia
     * $idProvincia int
     * return array
     */
    public static function getLocalidades($idProvincia) 
    {
        $localidadControl = new \app\models\Localidad();
        $localidadLista = $localidadControl::find()
        ->where(['idProvincia'=>$idProvincia])
        ->asArray()
        ->all();
        foreach ($localidadLista as $i => $localidad) {
            $out[] = ['id' => $localidad['idLocalidad'], 'name' => $localidad['nombreLocalidad']];
        }          
        return $out;
    }
}
