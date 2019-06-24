<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query; 
use yii\data\ActiveDataProvider;
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
    public $rol;
    public $email;
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
            [['nombreGestor', 'apellidoGestor'], 'required'],
            [['nombreGestor', 'apellidoGestor'], 'string', 'max' => 64],
            [['telefonoGestor'], 'string', 'max' => 32],
            [['telefonoGestor'], 'required'],
            [['rol','email'],'safe'],
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
            'nombreGestor' => 'Nombre',
            'apellidoGestor' => 'Apellido',
            'telefonoGestor' => 'Telefono',
            'idUsuario' => 'Dni',
            'rol' => 'Rol',
            'email'=> 'Email',
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

    public function Adminbusquedas(){
        $query = new Query;
        $query 
           ->select(['g.idGestor,(g.nombreGestor) as Nombre, (g.apellidoGestor) as Apellido,(g.telefonoGestor) as Telefono,(r.descripcionRol) as Rol, (u.dniUsuario) as DNI, (u.mailUsuario) as Email'])
           ->from('gestores g')
           ->join('inner join','usuario u','u.idUsuario=g.idusuario')
           ->join('inner join','rol r','r.idRol=u.idRol')
	       ->where(['r.idRol'=>'2']) 
           ->all();
        $dataProvider = new ActiveDataProvider([
              'query' => $query,
        ]);
    return $dataProvider;
    }
    
    public function Gestorbusquedas(){
        $query = new Query;
        $query 
           ->select(['g.idGestor,(g.nombreGestor) as Nombre, (g.apellidoGestor) as Apellido,(g.telefonoGestor) as Telefono,(r.descripcionRol) as Rol, (u.dniUsuario) as DNI, (u.mailUsuario) as Email'])
           ->from('gestores g')
           ->join('inner join','usuario u','u.idUsuario=g.idusuario')
           ->join('inner join','rol r','r.idRol=u.idRol')
	       ->where(['r.idRol'=>'3']) 
           ->all();
        $dataProvider = new ActiveDataProvider([
              'query' => $query,
        ]);
    return $dataProvider;
    }
}
