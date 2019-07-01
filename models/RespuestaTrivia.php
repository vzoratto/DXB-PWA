<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta_trivia".
 *
 * @property int $idRespTrivia
 * @property string $respTriviaValor
 * @property int $idPregunta
 */
class RespuestaTrivia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respuesta_trivia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['respTriviaValor', 'idPregunta'], 'required'],
            [['idPregunta'], 'integer'],
            [['respTriviaValor'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRespTrivia' => 'Id Resp Trivia',
            'respTriviaValor' => 'Resp Trivia Valor',
            'idPregunta' => 'Id Pregunta',
        ];
    }
}
