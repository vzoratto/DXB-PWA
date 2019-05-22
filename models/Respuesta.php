<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta".
 *
 * @property int $idRespuesta
 * @property string $respValor
 * @property int $idPregunta
 * @property int $idPersona
 */
class Respuesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respuesta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['respValor', 'idPregunta'], 'required'],
            [['idPregunta', 'idPersona'], 'integer'],
            [['respValor'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRespuesta' => 'Id Respuesta',
            'respValor' => 'Resp Valor',
            'idPregunta' => 'Id Pregunta',
            'idPersona' => 'Id Persona',
        ];
    }
}
