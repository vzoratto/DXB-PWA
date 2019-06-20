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
use app\models\Respuesta;
use app\models\Respuestaopcion;
use app\models\Equipo;
use app\models\Grupo;
use app\models\Parametros;
use app\models\Carrerapersona;
use yii\base\Security;


use yii\helper\Json;

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
        $equipo = new \app\models\Equipo(); //Instanciamos una variable
        $talleRemera=new Talleremera();
        $provinciaLista = ArrayHelper::map(\app\models\Provincia::find()->all(),'idProvincia','nombreProvincia'); //Lista de las provincias
        $listadoTalles=ArrayHelper::map(\app\models\Talleremera::find()->all(),'idTalleRemera','talleRemera');
        $respuesta=new \app\models\Respuesta();
        $tipoCarrera = new \app\models\Tipocarrera(); //Instanciamos una variable
        $tipocarreraLista =ArrayHelper::map(\app\models\Tipocarrera::find()->all(),'idTipoCarrera','descripcionCarrera');
        $cantCorredores =ArrayHelper::map(\app\models\Parametros::find()->all(),'idParametros','cantidadCorredores');
        $carrerapersona = new \app\models\Carrerapersona();

        $equipoLista= ArrayHelper::map(\app\models\Equipo::find()
        ->select('COUNT(equipo.idEquipo) AS cantidadCorredores','grupo.idEquipo,equipo.cantidadPersonas,equipo.dniCapitan,')
        ->innerJoin('grupo','equipo.idEquipo=grupo.idEquipo')
        ->groupBy(['equipo.idEquipo'])
        ->having('COUNT(equipo.idEquipo)<equipo.cantidadPersonas')
        ->all(),'idEquipo','dniCapitan');

        if(yii::$app->user->isGuest){
            return $this->goHome();
        }

        $userLogueado=Yii::$app->user;

        return $this->render('index',[
            'persona'=>$persona,
            'usuario'=>$usuario,
            'personaDireccion'=>$personaDireccion,
            'fichaMedica'=>$fichaMedica,
            'datosEmergencia'=>$datosEmergencia,
            'localidad' => $localidad,
            'provincia' => $provincia,
            'provinciaLista' => $provinciaLista,
            'listadoTalles'=>$listadoTalles,
            'talleRemera'=>$talleRemera,
            'equipoLista'=>$equipoLista,
            'equipo'=>$equipo,
            'tipoCarrera'=>$tipoCarrera,
            'tipocarreraLista'=>$tipocarreraLista,
            'cantCorredores'=>$cantCorredores,
            'swicht'=>null,
            'datos' => null,
            'respuesta'=>$respuesta,
            'user'=>$userLogueado,
            'carrerapersona'=>$carrerapersona
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

    public function actionDatos()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0];
                //$out = [
                //    ['id'=>'1', 'name'=>$idEquipo],
                //    ['id'=>'2', 'name'=>'<sub-cat-name2>']
                //];
                $elEquipo= ArrayHelper::map(\app\models\Equipo::find()->where(['idEquipo' => $idEquipo])->all(),'idEquipo','nombreEquipo');

            
                $out = [
                    ['id' => $idEquipo, 'name' => $elEquipo[$idEquipo]]
                ];
            
            
                return ['output'=>$out, 'selected'=>$idEquipo];
            }
        }
        return ['output'=>'', 'selected'=>''];  
    }

    public function actionTipocarrera()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0];
                //$out = [
                //    ['id'=>'1', 'name'=>$idEquipo],
                //    ['id'=>'2', 'name'=>'<sub-cat-name2>']
                //];
                $equipo= ArrayHelper::map(\app\models\Equipo::find()->where(['idEquipo' => $idEquipo])->all(),'idEquipo','idTipoCarrera');
                $idTipoCarrera = $equipo[$idEquipo];
                $carrera= ArrayHelper::map(\app\models\Tipocarrera::find()->where(['idTipoCarrera' => $idTipoCarrera])->all(),'idTipoCarrera','descripcionCarrera');

            
                $out = [
                    ['id' => $idTipoCarrera, 'name' => $carrera[$idTipoCarrera]]
                ];
            
            
                return ['output'=>$out, 'selected'=>$idTipoCarrera];
            }
        }
        return ['output'=>'', 'selected'=>''];  
    }

    public function actionCantpersonas()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0];
                //$out = [
                //    ['id'=>'1', 'name'=>$idEquipo],
                //    ['id'=>'2', 'name'=>'<sub-cat-name2>']
                //];
                $elEquipo= ArrayHelper::map(\app\models\Equipo::find()->where(['idEquipo' => $idEquipo])->all(),'idEquipo','cantidadPersonas');

            
                $out = [
                    ['id' => $idEquipo, 'name' => $elEquipo[$idEquipo]]
                ];
            
            
                return ['output'=>$out, 'selected'=>$idEquipo];
            }
        }
        return ['output'=>'', 'selected'=>''];

    }

    public function actionNombrecapitan()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0];
                /*$out = [
                    ['id'=>'1', 'name'=>$idEquipo]
                   ['id'=>'2', 'name'=>'<sub-cat-name2>']
                ];
                */
                
                $elEquipo= ArrayHelper::map(\app\models\Equipo::find()->where(['idEquipo' => $idEquipo])->all(),'idEquipo','dniCapitan');
                $objControlEquipo = new Equipo();
                $objEquipo = Equipo::find()->where(['idEquipo'=>$idEquipo])->one();
                $dniCapitan=$objEquipo['dniCapitan'];  

                $objControlUsuario = new Usuario();
                $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniCapitan])->one();
                $idUsu = $objUsuario['idUsuario'];

                $objControlPersona = new Persona();
                $objPersona = Persona::find()->where(['idUsuario'=>$idUsu])->one();
                $nombrePersona = $objPersona['nombrePersona'];
                $apellidoPersona = $objPersona['apellidoPersona'];
                $nombreCompleto = $nombrePersona . " " . $apellidoPersona;

            
                $out = [
                    ['id' => $idUsu, 'name' => $nombreCompleto]
                ];
            
                return ['output'=>$out, 'selected'=>$idUsu];
            }
        }
        return ['output'=>'', 'selected'=>''];

    }

    /**
     * Guarda los datos del formulario en sus correspondientes tablas de la base de datos
     */
    public function actionStore(){

        $guardado=false;
        $transaction = Persona::getDb()->beginTransaction();
        $userLogueado=Yii::$app->user;

        //print_R(Yii::$app->request->post());
        try {
            //Si la gestora ingreasa un corredor
            $idRol = $userLogueado->identity->idRol;
            if ($idRol == 3 ){ // Si es gestora
                //MODELO USUARIO

                $modeloUsuario=Yii::$app->request->post()['Usuario'];
                $dniUsuario = $modeloUsuario['dniUsuario'];

                $modeloPersona=Yii::$app->request->post()['Persona'];
                $mailUsuario = $modeloPersona['mailPersona'];
                $usuario = new Usuario();
                $usuario->dniUsuario = $dniUsuario;
                $usuario->mailUsuario = $mailUsuario;
                $usuario->activado = 1;
                $usuario->idRol = 4; //invitado

                $security = new Security();
                $authkey = $security->generateRandomString(50);
                $usuario->authkey = $authkey; //clave será utilizada para activar el usuario
                
                $usuario->claveUsuario = crypt($dniUsuario,Yii::$app->params["salt"]);

                $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniUsuario])->One();
                if ($objUsuario == null) { // Es decir, no existe el usuario con ese DNI en la BD
                    $existeUsuario = false;
                } else {
                    $existeUsuario = true;
                }
                

                if ($usuario->validate() && !($existeUsuario)) {
                    // toda la entrada es válida
                    $usuario->save();
                    $idUsuario = Yii::$app->db->getLastInsertID();
                } else {
                    // la validación falló: $erroresPersonaDireccion es un array que contienen los mensajes de error
                    $usuario = $usuario->errors;
                    
                }
            }else{
                $idUsuario=Yii::$app->user->identity->idUsuario;
            }
            //MODELO LOCALIDAD
            $modeloLocalidad=Yii::$app->request->post()['Localidad'];
            //MODELO PERSONA DIRECCION
           // $modeloPersonaDireccion=Yii::$app->request->post()['Personadireccion'];
            $direccion=Yii::$app->request->post()['calle'].' '.Yii::$app->request->post()['numero'].' '.Yii::$app->request->post()['piso'].' '.Yii::$app->request->post()['departamento'];
            $personaDireccion=new Personadireccion();
            $personaDireccion->idLocalidad=$modeloLocalidad['idLocalidad'];
            $personaDireccion->direccionUsuario=$direccion;
            if ($personaDireccion->validate()) {
                // toda la entrada es válida
                $personaDireccion->save();
            } else {
                // la validación falló: $erroresPersonaDireccion es un array que contienen los mensajes de error
                $erroresPersonaDireccion = $personaDireccion->errors;
            }
            
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
            if ($fichaMedica->validate()) {
                // toda la entrada es válida
                $fichaMedica->save();
            } else {
                // la validación falló: $erroresFichaMedica es un array que contienen los mensajes de error
                $erroresFichaMedica = $fichaMedica->errors;
            }


            //MODELO PERSONAEMERGENCIA
            $modeloPersonaemergencia=Yii::$app->request->post()['Personaemergencia'];
            $personaEmergencia=new Personaemergencia();
            $personaEmergencia->nombrePersonaEmergencia=$modeloPersonaemergencia['nombrePersonaEmergencia'];
            $personaEmergencia->apellidoPersonaEmergencia=$modeloPersonaemergencia['apellidoPersonaEmergencia'];
            $personaEmergencia->telefonoPersonaEmergencia=$modeloPersonaemergencia['telefonoPersonaEmergencia'];
            $personaEmergencia->idVinculoPersonaEmergencia=$modeloPersonaemergencia['idVinculoPersonaEmergencia'];
            if ($personaEmergencia->validate()) {
                // toda la entrada es válida
                $personaEmergencia->save();
            } else {
                // la validación falló: $erroresPersonaEmergencia es un array que contienen los mensajes de error
                $erroresPersonaEmergencia = $personaEmergencia->errors;
            }


            $fecha=new \DateTime();
            $fechaActual=$fecha->format('Y-m-d H:i:s');

            //TALLE REMERA
            $idTalleRemera=Yii::$app->request->post()['Talleremera']['idTalleRemera'];


            //MODELO PERSONA
            $modeloPersona=Yii::$app->request->post()['Persona'];
            $persona=new Persona();
            //$persona->dniCapitan=$modeloPersona['dniCapitan'];
            $persona->idTalleRemera=$idTalleRemera;
            $persona->nombrePersona=$modeloPersona['nombrePersona'];
            $persona->apellidoPersona=$modeloPersona['apellidoPersona'];
            $persona->fechaNacPersona=Yii::$app->request->post()['Persona']['fechaNacPersona'];
            $persona->sexoPersona=$modeloPersona['sexoPersona'];
            $persona->nacionalidadPersona=$modeloPersona['nacionalidadPersona'];
            $persona->telefonoPersona=$modeloPersona['telefonoPersona'];
            $persona->mailPersona=$modeloPersona['mailPersona'];
            $persona->idUsuario=$idUsuario;
            $persona->idPersonaDireccion=$personaDireccion->idPersonaDireccion;
            $persona->idFichaMedica=$fichaMedica->idFichaMedica;
            $persona->fechaInscPersona=null;
            $persona->idPersonaEmergencia=$personaEmergencia->idPersonaEmergencia;
            $persona->donador=$modeloPersona['donador'];
            //$persona->estadoPago=null;
            if ($persona->validate()) {
                // toda la entrada es válida
                $persona->save(false);
            } else {
                // la validación falló: $erroresPersonaEmergencia es un array que contienen los mensajes de error
                $erroresPersona = $persona->errors;
                print_R($persona->fechaNacPersona);
                print_R($persona->errors);
            }
            
            $idDbPersona = Yii::$app->db->getLastInsertID();

            $idPersona=$persona->idPersona;
           // echo $idPersona;
            
          //  print_r($persona->errors);
            //die();


            //ESTADO PAGO
            $estadoPagoPersona=new Estadopagopersona();
            $estadoPagoPersona->idEstadoPago=1;
            
            $estadoPagoPersona->idPersona=$persona->primaryKey();
            $estadoPagoPersona->fechaPago=$fechaActual;
            $estadoPagoPersona->save();
            // print_r($estadoPagoPersona->errors);

            //MODELO EQUIPO
            if (!Yii::$app->request->post()['swichtCapitan']){ 
                //Si no es capitan
                $modeloEquipo=Yii::$app->request->post()['Equipo']['idEquipo'];
                $grupo=new Grupo();
                $grupo->idEquipo=$modeloEquipo;
                $grupo->idPersona=$idPersona;
                $grupo->save();

            }else{
                // Si es capitan
                $grupo=new Grupo();
                $equipo=new Equipo();
                $cantidadPersonas=Yii::$app->request->post()['Equipo']['cantidadPersonas'];
                $idTipoCarrera=Yii::$app->request->post()['Tipocarrera']['idTipoCarrera'];
                $parametricaCantidadPersonas = ArrayHelper::map(\app\models\Parametros::find()->where(['idParametros' => $cantidadPersonas])->all(),'idParametros','cantidadCorredores');

                $equipo->cantidadPersonas=$parametricaCantidadPersonas[$cantidadPersonas];
                $equipo->idTipoCarrera=$idTipoCarrera;
                $equipo->dniCapitan=Yii::$app->request->post()['Usuario']['dniUsuario'];
                $equipo->save();
                $idDbEquipo = Yii::$app->db->getLastInsertID();
                $equipo->nombreEquipo=$idDbEquipo;
                $equipo->update();
                $grupo->idEquipo=$idDbEquipo;
                $grupo->idPersona=$idDbPersona;
                $grupo->save();

            }

            //MODELO CARRERAPERSONA
            $carreraPersona = new Carrerapersona();
            $modeloCarreraPersona = Yii::$app->request->post()['Carrerapersona'];
            
            if (!Yii::$app->request->post()['swichtCapitan']){ //Si no es capitan
                $idEquipo=Yii::$app->request->post()['Equipo']['idEquipo'];
                
                $objControlEquipo = new Equipo();
                $objEquipo = Equipo::find()->where(['idEquipo'=>$idEquipo])->one();
                $idTipoCarrera=$objEquipo['idTipoCarrera'];  
            }
            
            $carreraPersona->idPersona=$persona->idPersona;
            $carreraPersona->idTipoCarrera = $idTipoCarrera;
            $carreraPersona->reglamentoAceptado = $modeloCarreraPersona['reglamentoAceptado'];
            $carreraPersona->save();
            //idTipoCarrera idPersona reglamentoAceptado
            //$carreraPersona->idPersona=$persona->idPersona;
            
            //$carreraPersona->idTipoCarrera = $idTipoCarrera;
            

            //RESPUESTA A ENCUESTA
            $respuesta=Yii::$app->request->post();
            foreach($respuesta as $clave=>$valor){
                if(is_numeric($clave)){
                    if(is_array($valor)){
                        foreach($valor as $unValor){
                            if(is_numeric($unValor)){
                                $opcion=Respuestaopcion::findOne($unValor);
                                $resp['respValor']=$opcion->opRespvalor;
                            }else{
                                $resp['respValor']=$unValor;
                            }
                            $resp['idPregunta']=$clave;
                            $resp['idPersona']=$idPersona;

                            $model=new Respuesta();
                            $model->respValor=$resp['respValor'];
                            $model->idPregunta=$resp['idPregunta'];
                            $model->idPersona=$resp['idPersona'];
                            $model->save();
                        }
                    }else{
                        if(is_numeric($valor)){
                            $opcion=Respuestaopcion::findOne($valor);
                            $resp['respValor']=$opcion->opRespvalor;
                        }else{
                            $resp['respValor']=$valor;
                        }
                        $resp['idPregunta']=$clave;
                        $resp['idPersona']=$idPersona;

                        $model=new Respuesta();
                        $model->respValor=$resp['respValor'];
                        $model->idPregunta=$resp['idPregunta'];
                        $model->idPersona=$resp['idPersona'];
                        $model->save();
                    }
                }    
            }

            $transaction->commit();
             $guardado=true;
            if ($guardado){     //Si la inscripcion es guardada correctamente

                $idUsuario= Yii::$app->user->identity->idUsuario;
                $usuario=Usuario::find()->where(['idUsuario'=>$idUsuario])->one();
                //mail de confirmacion de inscripcion
                $subject = "Inscripcion y reglamento";
                $body = "<h1>Gracias por inscribirse a la carrera". $usuario->dniUsuario .". Clickee en el siguiente link para ver el reglamento que ha aceptado</h1>";
                $body .= "<a href='http://localhost/carrera/web/index.php'>Reglamento</a>";

                Yii::$app->mailer->compose()
                    ->setFrom('carreraxbarda@gmail.com')
                    //->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                    ->setTo($usuario->mailUsuario)
                    //->setTo('carreraxbarda@gmail.com')
                    ->setSubject($subject)
                    ->setHTMLBody($body)
                    ->send();


                $mensaje = "Enviamos un email con su registro de inscripcion ";
                return Yii::$app->response->redirect(['site/index','guardado'=>$guardado,'mensaje'=>$mensaje])->send();
            }else{
                $mensaje = "Ha ocurrido un error al llevar a cabo tu inscripcion,vuelve a intentarlo";
                return Yii::$app->response->redirect(['site/index','guardado'=>$guardado,'mensaje'=>$mensaje])->send();
            }




        } catch(\Exception $e) {
            $guardado=false;

            $transaction->rollBack();
            throw $e;
        }


            //return Yii::$app->response->redirect(['site/index','guardado'=>$guardado])->send();



    }
    
}
