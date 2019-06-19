<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
/**
 * This is the model class for table "pagoinscripcion".
 *
 * @property int $idPago
 * @property int $importe
 * @property string $entidadpago
 * @property string $imagencomprobante
 * @property string $fechapago
 * @property int $pagado
 * @property int $idPersona
 *
 * @property Persona $persona
 */
class Pagoinscripcion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pagoinscripcion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['importe', 'idPersona','imagencomprobante','entidadpago'], 'required'],
            [['importe', 'pagado', 'idPersona'], 'integer'],
            [['fechapago'], 'safe'],
            [['entidadpago'], 'string', 'max' => 64],
            [['imagencomprobante'], 'file','extensions' => 'jpg, jpeg, png, bmp, jpe'],
            [['idPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['idPersona' => 'idPersona']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPago' => 'Id Pago',
            'importe' => 'Importe',
            'entidadpago' => 'Entidad de pago',
            'fechapago' => 'Fecha pago',
            'pagado' => 'Pagado',
            'idPersona' => 'Persona',
            'imagencomprobante' => 'Seleccionar imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['idPersona' => 'idPersona']);
    }

    public function getUsupersona(){
       //$id=Usuario::findIdentity($_SESSION['__id']);
       //return Persona::find()->where($id->idUsuario)()->One();
       return  Persona::findOne(['idUsuario' => $_SESSION['__id']]);
       
    }
}