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
 *
 * @property Encuesta $encuesta
 * @property RespuestaTipo $respTipo
 * @property Respuesta[] $respuestas
 * @property RespuestaOpcion[] $respuestaOpcions
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
            [['idEncuesta'], 'exist', 'skipOnError' => true, 'targetClass' => Encuesta::className(), 'targetAttribute' => ['idEncuesta' => 'idEncuesta']],
            [['idRespTipo'], 'exist', 'skipOnError' => true, 'targetClass' => RespuestaTipo::className(), 'targetAttribute' => ['idRespTipo' => 'idRespTipo']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEncuesta()
    {
        return $this->hasOne(Encuesta::className(), ['idEncuesta' => 'idEncuesta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespTipo()
    {
        return $this->hasOne(RespuestaTipo::className(), ['idRespTipo' => 'idRespTipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['idPregunta' => 'idPregunta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaOpcions()
    {
        return $this->hasMany(RespuestaOpcion::className(), ['idPregunta' => 'idPregunta']);
    }
}
