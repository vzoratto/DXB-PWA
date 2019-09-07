<?php

namespace app\models;

use Yii;
use Yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\Listadeespera;

/**
 * This is the model class for table "persona".
 *
 * @property int $idPersona
 * @property int $idTalleRemera
 * @property string $nombrePersona
 * @property string $apellidoPersona
 * @property string $fechaNacPersona
 * @property string $sexoPersona
 * @property string $nacionalidadPersona
 * @property string $telefonoPersona
 * @property string $mailPersona
 * @property int $idUsuario
 * @property int $idPersonaDireccion
 * @property int $idFichaMedica
 * @property string $fechaInscPersona
 * @property int $idPersonaEmergencia
 * @property int $idResultado
 * @property int $donador
 * @property int $deshabilitado
 *
 * @property Carrerapersona[] $carrerapersonas
 * @property Tipocarrera[] $tipoCarreras
 * @property Estadopagopersona[] $estadopagopersonas
 * @property Estadopago[] $estadoPagos
 * @property Grupo[] $grupos
 * @property Equipo[] $equipos
 * @property Usuario $usuario
 * @property Personaemergencia $personaEmergencia
 * @property Personadireccion $personaDireccion
 * @property Fichamedica $fichaMedica
 * @property Resultado $resultado
 * @property Talleremera $talleRemera
 * @property Respuesta[] $respuestas
 */
class Persona extends \yii\db\ActiveRecord
{
    public $dniUsuario;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             //definicion de campos obligatorios
             [['nombrePersona','nacionalidadPersona','apellidoPersona','idTalleRemera', 'donador', 'mailPersona', 'idUsuario','sexoPersona','fechaNacPersona','telefonoPersona'], 'required','message' => 'Este campo es obligatorio.'],
             //verifica que la direccion de mail sea valida
             ['mailPersona','email','message' => 'No es una direccion de email válida.'],
             //valida que los campos nombrados sean de tipo entero
             [['idTalleRemera', 'idUsuario', 'idPersonaDireccion', 'idFichaMedica', 'idPersonaEmergencia', 'idResultado', 'donador', 'deshabilitado'], 'integer'],
             // marca las variables como atributo seguro
             [['fechaNacPersona', 'fechaInscPersona'], 'safe'],
             //verifica que el formato de fecha sea el deseado
             [['fechaNacPersona'],'date', 'format'=>'yyyy-mm-dd'],
             [['fechaInscPersona'],'date', 'format'=>'yyyy-mm-dd H:m:s'],
             //comprueba si el valor del campo es 0 o 1, sin mirar el tipo de dato
             ['donador', 'boolean'],
             // comprueba si los campos coinciden con la expresion regular dada
             [['nombrePersona','apellidoPersona','nacionalidadPersona'],'match','pattern'=>"/^[a-z-A-Z\D]+$/",'message'=>"Unicamente se aceptan caracteres alfanumericos"],
             [['telefonoPersona'], 'match', 'pattern' => '/^\+?([0-9])*$/','message'=>'El formato es inválido'],
             // comprueba si los atributos son cadenas con una longitud que se encuentre en el rango que se definio
             [['nombrePersona', 'apellidoPersona', 'nacionalidadPersona', 'mailPersona'], 'string', 'length' => [2,64],'message'=>'Minimo 3 y maximo 64 caracteres'],
             [['sexoPersona'], 'string', 'max' => 1],
             [['telefonoPersona'], 'string', 'max' => 32],
             //claves foraneas, se valida que existan y que pertenezcan a la clase correspondiente a la que hace referencia
             [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
             [['idPersonaEmergencia'], 'exist', 'skipOnError' => true, 'targetClass' => Personaemergencia::className(), 'targetAttribute' => ['idPersonaEmergencia' => 'idPersonaEmergencia']],
             [['idPersonaDireccion'], 'exist', 'skipOnError' => true, 'targetClass' => Personadireccion::className(), 'targetAttribute' => ['idPersonaDireccion' => 'idPersonaDireccion']],
             [['idFichaMedica'], 'exist', 'skipOnError' => true, 'targetClass' => Fichamedica::className(), 'targetAttribute' => ['idFichaMedica' => 'idFichaMedica']],
             [['idResultado'], 'exist', 'skipOnError' => true, 'targetClass' => Resultado::className(), 'targetAttribute' => ['idResultado' => 'idResultado']],
             [['idTalleRemera'], 'exist', 'skipOnError' => true, 'targetClass' => Talleremera::className(), 'targetAttribute' => ['idTalleRemera' => 'idTalleRemera']],
             ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPersona' => 'Id Persona',
            'idTalleRemera' => 'Talle Remera',
            'nombrePersona' => 'Nombre ',
            'apellidoPersona' => 'Apellido',
            'fechaNacPersona' => 'Fecha Nacimiento',
            'sexoPersona' => 'Sexo',
            'nacionalidadPersona' => 'Nacionalidad ',
            'telefonoPersona' => 'Telefono',
            'mailPersona' => 'Mail',
            'idUsuario' => 'Id Usuario',
            'dniUsuario'=>'DNI corredor',
            'idPersonaDireccion' => 'Direccion',
            'idFichaMedica' => 'Ficha Medica',
            'fechaInscPersona' => 'Fecha Inscripcion',
            'idPersonaEmergencia' => 'Persona Emergencia',
            'idResultado' => 'Id Resultado',
            'donador' => 'Donador',
            'deshabilitado' => 'Deshabilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrerapersona()
    {
        return $this->hasMany(Carrerapersona::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCarrera()
    {
        return $this->hasMany(Tipocarrera::className(), ['idTipoCarrera' => 'idTipoCarrera'])->viaTable('carrerapersona', ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadopagopersona()
    {
        return $this->hasMany(Estadopagopersona::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPago()
    {
        return $this->hasMany(Estadopago::className(), ['idEstadoPago' => 'idEstadoPago'])->viaTable('estadopagopersona', ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasMany(Grupo::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasMany(Equipo::className(), ['idEquipo' => 'idEquipo'])->viaTable('grupo', ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDniUsuario()
    {
        return ' DNI '.$this->dniUsuario;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaEmergencia()
    {
        return $this->hasOne(Personaemergencia::className(), ['idPersonaEmergencia' => 'idPersonaEmergencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaDireccion()
    {
        return $this->hasOne(Personadireccion::className(), ['idPersonaDireccion' => 'idPersonaDireccion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichaMedica()
    {
        return $this->hasOne(Fichamedica::className(), ['idFichaMedica' => 'idFichaMedica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResultado()
    {
        return $this->hasOne(Resultado::className(), ['idResultado' => 'idResultado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTalleRemera()
    {
        return $this->hasOne(Talleremera::className(), ['idTalleRemera' => 'idTalleRemera']);
    }
    public function getTalle(){
        $dropciones=Talleremera::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idTalleRemera','talleRemera');
    }
    
    public function getListadeespera()
    {
        return $this->hasOne(Listadeespera::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuesta::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * Devuelbe el nombre completo de la persona
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombrePersona.' '.$this->apellidoPersona;
    }

    //si al actualizar el email , es el mismo que el del usuario actual
    public function mismoUsuarioEmail($email){
        $mismo=false;
        //usuario actual
        $usuario=Usuario::findOne(['idUsuario'=>$_SESSION['__id']]);

        //si el usuario quiere actualizar su email
        if($usuario->mailUsuario==$email){
            $mismo=true;

        }else{
            $mismo=false;
        }
        return $mismo;
    }
    //no existe un email igual al introducido
    public function noExisteEmail($email){
        $valido=true;
        $usuarioConEmailIntroducido=Usuario::findOne(['mailUsuario'=>$email]);
        if($usuarioConEmailIntroducido==null){
            $valido=true;
        }else{
            $valido=true;
        }
        return $valido;
    }



    public function inscrito(){
        //0 para los usuarios visitantes
        //1 para los inscriptos
        //2 para los no inscriptos
       
        $estado=0;
        if(!Yii::$app->user->isGuest){
            $persona=self::findOne(['idUsuario' => $_SESSION['__id']]);
            if($persona!=null){
               $estado=1;
            }else{
                $estado=2;
            }
        }else{
            //es visitante
            $estado=0;
        }
        return $estado;
    }

    public function estoyEnEspera(){
        //$enEspera=true;
        $listaEspera=Listadeespera::find()->where(['idPersona'=>$this->idPersona])->one();
        if($listaEspera==null){
            $listaEspera=false;

        }else{
            $listaEspera=true;
        }

        return $listaEspera;
    }

    public function soyCapitan(){
        $dni=$this->usuario->dniUsuario;
        $capitan=false;
        //$equipo=Equipo::find()->where(['dniCapitan'=>$dni])->one();
        $equipo=Equipo::findOne(['dniCapitan'=>$dni]);


        if($equipo){
            $capitan=true;

        }


        return $capitan;
    }

    //el equipo al que pertenezco
    public function equipo(){
        //busca al equipo al cual pertenezco
        $equipoAlQuePerteneezco=Grupo::findOne(['idPersona'=>$this->idPersona]);

        return $equipoAlQuePerteneezco;
    }

    public function dni(){
        $usuario=Usuario::findOne(['idUsuario'=>$this->idUsuario]);
        return $usuario->dniUsuario;

    }

    public function dniCapitan(){
        $equipoAlQuePerteneezco=Grupo::findOne(['idPersona'=>$this->idPersona]);
        $equipo=Equipo::findOne(['idEquipo'=>$equipoAlQuePerteneezco->idEquipo]);
        $dniCapitan=$equipo->dniCapitan;

        if($dniCapitan==$this->dni()){
            $dniCapitan='<span style="color:green">capitán</span>';
        }
        return $dniCapitan;

    }

    public function nombreCapitan(){
        $equipo=$this->equipo();
        $equipo=Equipo::findOne(['idEquipo'=>$equipo->idEquipo]);
        $dniCapitan=$equipo->dniCapitan;
        $usuCap=Usuario::findOne(['dniUsuario'=>$dniCapitan]);
        $personaCap=Persona::findOne(['idUsuario'=>$usuCap]);
        if($personaCap->idPersona==$this->idPersona){
            $nombreCap='<span style="color:green">capitán</span>';;
        }else{
            $nombreCap=strtolower($personaCap->apellidoPersona.' '.$personaCap->nombrePersona);
        }
        return $nombreCap;
    }

	
}
