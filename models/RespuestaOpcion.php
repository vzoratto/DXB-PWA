<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta_opcion".
 *
 * @property int $idRespuestaOpcion
 * @property string $opRespvalor
 * @property int $idPregunta
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRespuestaOpcion' => 'Id Respuesta Opcion',
            'opRespvalor' => 'Op Respvalor',
            'idPregunta' => 'Id Pregunta',
        ];
    }
}
