<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta_tipo".
 *
 * @property int $idRespTipo
 * @property string $respTipoDescripcion
 */
class RespuestaTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respuesta_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['respTipoDescripcion'], 'required'],
            [['respTipoDescripcion'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRespTipo' => 'Id Resp Tipo',
            'respTipoDescripcion' => 'Resp Tipo Descripcion',
        ];
    }
}
