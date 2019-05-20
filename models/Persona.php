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
            [['idTalleRemera', 'dniCapitan', 'mailPersona', 'idUsuario'], 'required','message' => 'Esta informacion es obligatorio.'],
            ['mailPersona','email','message' => 'No es un e-mail válido.'],
            [['idTalleRemera', 'dniCapitan', 'idUsuario', 'idPersonaDireccion', 'idFichaMedica', 'idPersonaEmergencia', 'idResultado', 'donador', 'deshabilitado'], 'integer'],
            [['fechaNacPersona', 'fechaInscPersona'], 'safe'],
            [['nombrePersona', 'apellidoPersona', 'nacionalidadPersona', 'mailPersona'], 'string', 'max' => 64],
            [['sexoPersona'], 'string', 'max' => 1],
            [['telefonoPersona'], 'string', 'max' => 32],
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
            'nombrePersona' => 'Nombre Persona',
            'apellidoPersona' => 'Apellido Persona',
            'fechaNacPersona' => 'Fecha Nac Persona',
            'sexoPersona' => 'Sexo Persona',
            'nacionalidadPersona' => 'Nacionalidad Persona',
            'telefonoPersona' => 'Telefono Persona',
            'mailPersona' => 'Mail Persona',
            'idUsuario' => 'Id Usuario',
            'idPersonaDireccion' => 'Id Persona Direccion',
            'idFichaMedica' => 'Id Ficha Medica',
            'fechaInscPersona' => 'Fecha Insc Persona',
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
