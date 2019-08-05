<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fechacarrera".
 *
 * @property int $idFechaCarrera
 * @property string $fechaCarrera
 * @property string $fechaLimiteUno
 * @property string $fechaLimiteDos
 * @property int $deshabilitado
 * @property int $idTipoCarrera
 *
 * @property Tipocarrera $tipoCarrera
 */
class Fechacarrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fechacarrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fechaCarrera', 'idTipoCarrera'], 'required'],
            [['fechaCarrera', 'fechaLimiteUno', 'fechaLimiteDos'], 'safe'],
            [['deshabilitado', 'idTipoCarrera'], 'integer'],
            [['idTipoCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Tipocarrera::className(), 'targetAttribute' => ['idTipoCarrera' => 'idTipoCarrera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFechaCarrera' => 'Id Fecha Carrera',
            'fechaCarrera' => 'Fecha Carrera',
            'fechaLimiteUno' => 'Fecha Limite Uno',
            'fechaLimiteDos' => 'Fecha Limite Dos',
            'deshabilitado' => 'Deshabilitado',
            'idTipoCarrera' => 'Id Tipo Carrera',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCarrera()
    {
        return $this->hasOne(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }
}
