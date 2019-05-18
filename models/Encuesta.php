<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encuesta".
 *
 * @property int $idEncuesta
 *
 * @property Persona[] $personas
 */
class Encuesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encuesta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEncuesta' => 'Id Encuesta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idEncuesta' => 'idEncuesta']);
    }
}
