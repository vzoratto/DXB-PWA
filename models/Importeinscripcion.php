<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "importeinscripcion".
 *
 * @property int $idImporte
 * @property int $importe
 * @property int $deshabilitado
 * @property int $idTipoCarrera
 *
 * @property Tipocarrera $tipoCarrera
 * @property Pago[] $pagos
 */
class Importeinscripcion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'importeinscripcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['importe', 'idTipoCarrera'], 'required'],
            [['importe', 'deshabilitado', 'idTipoCarrera'], 'integer'],
            [['idTipoCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Tipocarrera::className(), 'targetAttribute' => ['idTipoCarrera' => 'idTipoCarrera']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idImporte' => 'Id Importe',
            'importe' => 'Importe',
            'deshabilitado' => 'Deshabilitado',
            'idTipoCarrera' => 'Tipo Carrera',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCarrera()
    {
        return $this->hasOne(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['idImporte' => 'idImporte']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarreraDescrip(){
        $dropciones=TipoCarrera::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idTipoCarrera','descripcionCarrera');
    }
}
