<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrerapersona".
 *
 * @property int $idTipoCarrera
 * @property int $idPersona
 * @property int $reglamentoAceptado
 *
 * @property Persona $persona
 * @property Tipocarrera $tipoCarrera
 */
class Carrerapersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrerapersona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTipoCarrera', 'idPersona'], 'required'],
            [['idTipoCarrera', 'idPersona', 'reglamentoAceptado'], 'integer'],
            [['idTipoCarrera', 'idPersona'], 'unique', 'targetAttribute' => ['idTipoCarrera', 'idPersona']],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
            [['idTipoCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Tipocarrera::className(), 'targetAttribute' => ['idTipoCarrera' => 'idTipoCarrera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipoCarrera' => 'Id Tipo Carrera',
            'idPersona' => 'Id Persona',
            'reglamentoAceptado' => 'Reglamento Aceptado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCarrera()
    {
        return $this->hasOne(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }
}
