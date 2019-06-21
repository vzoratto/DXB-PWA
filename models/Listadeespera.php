<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "listadeespera".
 *
 * @property int $idListaDeEspera
 * @property int $idPersona
 *
 * @property Persona $persona
 */
class Listadeespera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listadeespera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPersona'], 'required'],
            [['idPersona'], 'integer'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idListaDeEspera' => 'Id Lista De Espera',
            'idPersona' => 'Id Persona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }
}
