<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametros".
 *
 * @property int $idParametros
 * @property int $cantidadCorredores
 */
class Parametros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidadCorredores'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idParametros' => 'Id Parametros',
            'cantidadCorredores' => 'Cantidad Corredores',
        ];
    }
}
