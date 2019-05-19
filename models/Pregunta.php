<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property int $idPregunta
 * @property string $pregDescripcion
 * @property int $idEncuesta
 * @property int $idRespTipo
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pregDescripcion', 'idEncuesta', 'idRespTipo'], 'required'],
            [['idEncuesta', 'idRespTipo'], 'integer'],
            [['pregDescripcion'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPregunta' => 'Id Pregunta',
            'pregDescripcion' => 'Preg Descripcion',
            'idEncuesta' => 'Id Encuesta',
            'idRespTipo' => 'Id Resp Tipo',
        ];
    }
}
