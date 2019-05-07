<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gruposanguineo".
 *
 * @property int $idGrupoSanguineo
 * @property string $tipoGrupoSanguineo
 *
 * @property Fichamedica[] $fichamedicas
 */
class Gruposanguineo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gruposanguineo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipoGrupoSanguineo'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGrupoSanguineo' => 'Id Grupo Sanguineo',
            'tipoGrupoSanguineo' => 'Tipo Grupo Sanguineo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichamedicas()
    {
        return $this->hasMany(Fichamedica::className(), ['idGrupoSanguineo' => 'idGrupoSanguineo']);
    }
}
