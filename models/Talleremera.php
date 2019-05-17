<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "talleremera".
 *
 * @property int $idTalleRemera
 * @property int $deshabilitado
 * @property string $talleRemera
 *
 * @property Persona[] $personas
 */
class Talleremera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'talleremera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deshabilitado'], 'integer'],
            [['talleRemera'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTalleRemera' => 'Id Talle Remera',
            'deshabilitado' => 'Deshabilitado',
            'talleRemera' => 'Talle Remera',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['idTalleRemera' => 'idTalleRemera']);
    }
}
