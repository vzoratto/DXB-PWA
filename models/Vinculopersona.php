<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vinculopersona".
 *
 * @property int $idVinculo
 * @property string $nombreVinculo
 *
 * @property Personaemergencia[] $personaemergencias
 */
class Vinculopersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vinculopersona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreVinculo'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idVinculo' => 'Id Vinculo',
            'nombreVinculo' => 'Nombre Vinculo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaemergencias()
    {
        return $this->hasMany(Personaemergencia::className(), ['idVinculoPersonaEmergencia' => 'idVinculo']);
    }
}
