<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $idPersona
 * @property int $idTalleRemera
 * @property int $dniCapitan
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
 * @property Estadopagopersona[] $estadopagopersonas
 * @property Estadopago[] $estadoPagos
 * @property Usuario $usuario
 * @property Personaemergencia $personaEmergencia
 * @property Personadireccion $personaDireccion
 * @property Fichamedica $fichaMedica
 * @property Resultado $resultado
 * @property Talleremera $talleRemera
 */
class Persona extends \yii\db\ActiveRecord
{
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
            [['nombrePersona','apellidoPersona','idTalleRemera', 'dniCapitan', 'mailPersona', 'idUsuario','sexoPersona','fechaNacPersona'], 'required','message' => 'Este campo es obligatorio.'],
            //verifica que la direccion de mail sea valida
            ['mailPersona','email','message' => 'No es una direccion de email válida.'],
           
            //valida que los campos nombrados sean de tipo entero
            [['idTalleRemera', 'dniCapitan', 'idUsuario', 'idPersonaDireccion', 'idFichaMedica', 'idPersonaEmergencia', 'idResultado', 'donador', 'deshabilitado'], 'integer'],
            // marca las variables como atributo seguro
            [['fechaNacPersona', 'fechaInscPersona'], 'safe'],
            //verifica que el formato de fecha sea el deseado
            [['fechaNacPersona', 'fechaInscPersona'],'date', 'format'=>'yyyy-mm-dd'],
            //comprueba si el valor del campo es 0 o 1, sin mirar el tipo de dato
            ['donador', 'boolean'],
            // comprueba si los campos coinciden con la expresion regular dada
            [['nombrePersona','apellidoPersona','nacionalidad'],'match','pattern'=>"/^[a-z-A-Z\D]+$/",'message'=>"Unicamente se aceptan caracteres alfanumericos"],
            [['dniCapitan'],'match','pattern'=>"/^[0-9]*$/",'message'=>"Unicamente se aceptan caracteres numericos"],
            [['telefonoPersona'],'match','pattern'=>"/^(?:((?P<p1>(?:\( ?)?+)(?:\+|00)?(54)(?<p2>(?: ?\))?+)(?P<sep>(?:[-.]| (?:[-.] )?)?+)(?:(?&p1)(9)(?&p2)(?&sep))?|(?&p1)(0)(?&p2)(?&sep))?+(?&p1)(11|([23]\d{2}(\d)??|(?(-10)(?(-5)(?!)|[68]\d{2})|(?!))))(?&p2)(?&sep)(?(-5)|(?&p1)(15)(?&p2)(?&sep))?(?:([3-6])(?&sep)|([12789]))(\d(?(-5)|\d(?(-6)|\d)))(?&sep)(\d{4})|(1\d{2}|911))$/D",'message'=>"No es un formato de telefono valido"],
            // comprueba si los atributos son cadenas con una longitud que se encuentre en el rango que se definio
            [['nombrePersona', 'apellidoPersona', 'nacionalidadPersona', 'mailPersona'], 'string', 'length' => [3,64],'message'=>'Minimo 3 y maximo 64 caracteres'],
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
            'idTalleRemera' => 'Id Talle Remera',
            'dniCapitan' => 'Dni Capitan',
            'nombrePersona' => 'Nombre',
            'apellidoPersona' => 'Apellido ',
            'fechaNacPersona' => 'Fecha Nac',
            'sexoPersona' => 'Sexo',
            'nacionalidadPersona' => 'Nacionalidad',
            'telefonoPersona' => 'Telefono ',
            'mailPersona' => 'Mail ',
            'idUsuario' => 'Id Usuario',
            'idPersonaDireccion' => 'Id Persona Direccion',
            'idFichaMedica' => 'Id Ficha Medica',
            'fechaInscPersona' => 'Fecha Insc ',
            'idPersonaEmergencia' => 'Id Persona Emergencia',
            'idResultado' => 'Id Resultado',
            'donador' => 'Donador',
            'deshabilitado' => 'Deshabilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadopagopersonas()
    {
        return $this->hasMany(Estadopagopersona::className(), ['idPersona' => 'idPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoPagos()
    {
        return $this->hasMany(Estadopago::className(), ['idEstadoPago' => 'idEstadoPago'])->viaTable('estadopagopersona', ['idPersona' => 'idPersona']);
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
}
