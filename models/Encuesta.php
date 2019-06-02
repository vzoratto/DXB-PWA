<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encuesta".
 *
 * @property int $idEncuesta
 * @property string $encTitulo
 * @property string $encDescripcion
 * @property int $encPublica
 *
 * @property Pregunta[] $preguntas
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
        return [
            [['encTitulo', 'encDescripcion'], 'required'],
            [['encPublica'], 'integer'],
            [['encTitulo'], 'string', 'max' => 150],
            [['encDescripcion'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEncuesta' => 'Id Encuesta',
            'encTitulo' => 'Titulo',
            'encDescripcion' => 'Descripcion',
            'encPublica' => 'Publica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreguntas()
    {
        return $this->hasMany(Pregunta::className(), ['idEncuesta' => 'idEncuesta']);
    }
}
