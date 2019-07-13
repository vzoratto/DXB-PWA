<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta_trivia".
 *
 * @property int $idRespTrivia
 * @property string $respTriviaValor
 * @property int $idPregunta
 * 
 * @property Pregunta $pregunta
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
            [['idPregunta'], 'exist', 'skipOnError' => true, 'targetClass' => Pregunta::className(), 'targetAttribute' => ['idPregunta' => 'idPregunta']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRespTrivia' => 'Id Resp Trivia',
            'respTriviaValor' => 'Valor de respuesta trivia',
            'idPregunta' => 'Id Pregunta',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPregunta()
    {
        return $this->hasOne(Pregunta::className(), ['idPregunta' => 'idPregunta']);
    }
}
