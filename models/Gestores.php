<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "gestores".
 *
 * @property int $idGestor
 * @property string $nombreGestor
 * @property string $apellidoGestor
 * @property string $telefonoGestor
 * @property int $idUsuario
 *
 * @property Usuario $usuario
 */
class Gestores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gestores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario'], 'required'],
            [['idUsuario'], 'integer'],
            ['idUsuario', 'usuario_existe'],
            [['nombreGestor', 'apellidoGestor'], 'string', 'max' => 64],
            [['telefonoGestor'], 'string', 'max' => 32],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGestor' => 'Id Gestor',
            'nombreGestor' => 'Nombre Gestor',
            'apellidoGestor' => 'Apellido Gestor',
            'telefonoGestor' => 'Telefono Gestor',
            'idUsuario' => 'Dni Usuario',
        ];
    }
    public function usuario_existe($attribute, $params)
    {
       //Buscar el username en la tabla
        $table = Gestores::find()->where("idUsuario=:idUsuario", [":idUsuario" => $this->idUsuario]);
        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
                $this->addError($attribute, "El usuario seleccionado existe, verificar los datos.");
         }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }

    public function getDniusuarios(){
		
        $dropciones=Usuario::find()->where('idRol=2')->orWhere('idRol=3')->orderBy('dniUsuario asc')->asArray()->all();
        return ArrayHelper::map($dropciones,'idUsuario','dniUsuario');
    }

    public function getUsuarios()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario'])->viaTable(Rol::className(), ['idRol' => 'idRol']);
    }
}
