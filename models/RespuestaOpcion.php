<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta_opcion".
 *
 * @property int $idRespuestaOpcion
 * @property string $opRespvalor
 * @property int $idPregunta
 *
 * @property Pregunta $pregunta
 */
class RespuestaOpcion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respuesta_opcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['opRespvalor', 'idPregunta'], 'required'],
            [['idPregunta'], 'integer'],
            [['opRespvalor'], 'string', 'max' => 250],
            [['idPregunta'], 'exist', 'skipOnError' => true, 'targetClass' => Pregunta::className(), 'targetAttribute' => ['idPregunta' => 'idPregunta']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRespuestaOpcion' => 'Id Respuesta Opcion',
            'opRespvalor' => 'Opcion de Respuesta',
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
