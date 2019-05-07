<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $idProvincia
 * @property string $nombreProvincia
 * @property string $codigoIso31662
 *
 * @property Localidad[] $localidads
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProvincia', 'nombreProvincia', 'codigoIso31662'], 'required'],
            [['idProvincia'], 'integer'],
            [['nombreProvincia'], 'string', 'max' => 50],
            [['codigoIso31662'], 'string', 'max' => 4],
            [['idProvincia'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProvincia' => 'Id Provincia',
            'nombreProvincia' => 'Nombre Provincia',
            'codigoIso31662' => 'Codigo Iso31662',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidads()
    {
        return $this->hasMany(Localidad::className(), ['idProvincia' => 'idProvincia']);
    }
}
