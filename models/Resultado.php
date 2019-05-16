<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resultado".
 *
 * @property int $idResultado
 *
 * @property Persona[] $personas
 */
class Resultado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resultado';
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
            'idResultado' => 'Id Resultado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idResultado' => 'idResultado']);
    }
}
