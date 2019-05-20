<?php

namespace app\controllers;

use app\models\Estadopagopersona;
use app\models\Talleremera;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Persona;
use app\models\Usuario;
use app\models\Fichamedica;
use app\models\Localidad;
use app\models\Sexo;
use app\models\Gruposanguineo;
use app\models\Personadireccion;
use app\models\Personaemergencia;
use app\models\Provincia;
use yii\helpers\ArrayHelper;

class InscripcionController extends Controller
{
     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lista de todos los modelos de inscripcion
     * @return mixed
     */
    public function actionIndex()
    {
        //se instancia una variable por cada modelo a utilizar
        $persona = new \app\models\Persona(); //Instanciamos una variable
        $usuario = new \app\models\Usuario(); //Instanciamos una variable
        $personaDireccion = new \app\models\Personadireccion(); //Instanciamos una variable
        $fichaMedica = new \app\models\Fichamedica(); //Instanciamos una variable
        $datosEmergencia = new \app\models\Personaemergencia();//Instanciamos una variable
        $localidad = new \app\models\Localidad(); //Instanciamos una variable
        $provincia = new \app\models\Provincia(); //Instanciamos una variable
        $provinciaLista = ArrayHelper::map(\app\models\Provincia::find()->all(),'idProvincia','nombreProvincia'); //Lista de las provincias
        $talleRemera = new Talleremera(); //Instanciamos una variable
        $listadoTalles = ArrayHelper::map(\app\models\Talleremera::find()->all(),'idTalleRemera','talleRemera'); //Lista de talles



        //permite renderizar el index con todos los modelos necesarios para las demás acciones
        return $this->render('index',[
            'persona'=>$persona,
            'usuario'=>$usuario,
            'personaDireccion'=>$personaDireccion,
            'fichaMedica'=>$fichaMedica,
            'datosEmergencia'=>$datosEmergencia,
            'localidad' => $localidad,
            'provincia' => $provincia,
            //'personaDireccion' => $personaDireccion,
            'provinciaLista' => $provinciaLista,
            'listadoTalles'=>$listadoTalles,
            'talleRemera'=>$talleRemera
            ]);
    }

    /**
     * Lista del modelo de Contacto emergencia.
     * @return mixed
     */
    public function actionContactoemergencia()
    {
        $model = new \app\models\Personaemergencia(); //Instanciamos una variable

        return $this->render('contactoemergencia', [
            'model' => $model,
        ]);
    }
    
    /**
     * Lista del modelo de Datos de contacto.
     * @return mixed
     */
    public function actionDatoscontacto()
    {
        $personaDireccion = new \app\models\Personadireccion(); //Instanciamos una variable
        $persona= new \app\models\Persona(); //Instanciamos una variable

        return $this->render('datoscontacto', [
            'personaDireccion' => $personaDireccion,
            'persona' => $persona,
        ]);
    }
    
    /**
     * Lista del modelo de Datos Medicos.
     * @return mixed
     */
    public function actionDatosmedicos()
    {

        $model = new \app\models\Fichamedica(); //Instanciamos una variable

        return $this->render('datosmedicos', [
            'model' => $model,
        ]);
    }
    
    /**
     * Lista del modelo de Datos Personales.
     * @return mixed
     */
    public function actionDatospersonales()
    {

        $model = new \app\models\Persona(); //Instanciamos una variable
        $model1 = new \app\models\Usuario(); //Instanciamos una variable

        return $this->render('datospersonales', [
            'model' => $model,
            'model1' => $model1,
        ]);
    }

    /**
     * Lista del modelo de Encuesta.
     * @return mixed
     */
    public function actionEncuesta()
    {

        $model = new \app\models\Encuesta(); //Instanciamos una variable

        return $this->render('encuesta', [
            'model' => $model,
        ]);
    }

    /**
     * Guarda los datos del formulario en sus correspondientes tablas de la base de datos
     */
    public function actionStore(){
        $guardado=false;
        $transaction = Persona::getDb()->beginTransaction();
        //print_r(Yii::$app->request->post());
        //die();
        try {
            //MODELO USUARIO
            $modeloUsuario=Yii::$app->request->post()['Usuario'];
            $usuario=new Usuario();
            $usuario->idUsuario=null;
            $usuario->dniUsuario=$modeloUsuario['dniUsuario'];
            $usuario->mailUsuario=Yii::$app->request->post()['Persona']['mailPersona'];
            $hash = Yii::$app->getSecurity()->generatePasswordHash($modeloUsuario['dniUsuario']);
            $usuario->claveUsuario=$hash;
            $usuario->idRol=1;
            $usuario->save();
            $idUsuario=$usuario->idUsuario;


            //MODELO LOCALIDAD
            $modeloLocalidad=Yii::$app->request->post()['Localidad'];
            //MODELO PERSONA DIRECCION
            $modeloPersonaDireccion=Yii::$app->request->post()['Personadireccion'];
            $personaDireccion=new Personadireccion();
            $personaDireccion->idLocalidad=$modeloLocalidad['idLocalidad'];
            $personaDireccion->direccionUsuario=$modeloPersonaDireccion['direccionUsuario'];
            $personaDireccion->save();

            //MODELO FICHA MEDICA
            $modeloFichaMedica=Yii::$app->request->post()['Fichamedica'];
            $fichaMedica=new Fichamedica();
            $fichaMedica->obraSocial=$modeloFichaMedica['obraSocial'];
            $fichaMedica->peso=$modeloFichaMedica['peso'];
            $fichaMedica->altura=$modeloFichaMedica['altura'];
            $fichaMedica->frecuenciaCardiaca=$modeloFichaMedica['frecuenciaCardiaca'];
            $fichaMedica->idGrupoSanguineo=$modeloFichaMedica['idGrupoSanguineo'];
            $fichaMedica->evaluacionMedica=$modeloFichaMedica['evaluacionMedica'];
            $fichaMedica->intervencionQuirurgica=$modeloFichaMedica['intervencionQuirurgica'];
            $fichaMedica->tomaMedicamentos=$modeloFichaMedica['tomaMedicamentos'];
            $fichaMedica->suplementos=$modeloFichaMedica['suplementos'];
            $fichaMedica->observaciones=$modeloFichaMedica['observaciones'];
            $fichaMedica->save();


            //MODELO PERSONAEMERGENCIA
            $modeloPersonaemergencia=Yii::$app->request->post()['Personaemergencia'];
            $personaEmergencia=new Personaemergencia();
            $personaEmergencia->nombrePersonaEmergencia=$modeloPersonaemergencia['nombrePersonaEmergencia'];
            $personaEmergencia->apellidoPersonaEmergencia=$modeloPersonaemergencia['apellidoPersonaEmergencia'];
            $personaEmergencia->telefonoPersonaEmergencia=$modeloPersonaemergencia['telefonoPersonaEmergencia'];
            $personaEmergencia->idVinculoPersonaEmergencia=$modeloPersonaemergencia['idVinculoPersonaEmergencia'];
            $personaEmergencia->save();

            $fecha=new \DateTime();
            $fechaActual=$fecha->format('Y-m-d H:i:sP');

            //TALLE REMERA
            $idTalleRemera=Yii::$app->request->post()['Talleremera']['idTalleRemera'];


            //MODELO PERSONA
            $modeloPersona=Yii::$app->request->post()['Persona'];
            $persona=new Persona();
            $persona->dniCapitan=null;
            $persona->idTalleRemera=$idTalleRemera;
            $persona->nombrePersona=$modeloPersona['nombrePersona'];
            $persona->apellidoPersona=$modeloPersona['apellidoPersona'];
            $persona->fechaNacPersona=Yii::$app->request->post()['fechaNacPersona'];
            $persona->sexoPersona=$modeloPersona['sexoPersona'];
            $persona->nacionalidadPersona=$modeloPersona['nacionalidadPersona'];
            $persona->telefonoPersona=$modeloPersona['telefonoPersona'];
            $persona->mailPersona=$modeloPersona['mailPersona'];
            $persona->idUsuario=$idUsuario;
            $persona->idPersonaDireccion=$personaDireccion->idPersonaDireccion;
            $persona->idFichaMedica=$fichaMedica->idFichaMedica;
            $persona->fechaInscPersona=$fechaActual;
            $persona->idPersonaEmergencia=$personaEmergencia->idPersonaEmergencia;
            $persona->donador=$modeloPersona['donador'];
            //$persona->estadoPago=null;

            $persona->save();


            //ESTADO PAGO
            $estadoPagoPersona=new Estadopagopersona();
            $estadoPagoPersona->idEstadoPago=1;
            $estadoPagoPersona->idPersona=$persona->getPrimaryKey();
            $estadoPagoPersona->fechaPago=$fechaActual;
            $estadoPagoPersona->save();

            $transaction->commit();
            $guardado=true;
            print_r($persona->errors);
            die();

        } catch(\Exception $e) {
            $guardado=false;

            $transaction->rollBack();
            throw $e;
        }


            return Yii::$app->response->redirect(['site/index','guardado'=>$guardado])->send();



    }
    
}
