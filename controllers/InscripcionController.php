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
use app\models\Listadeespera;
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]); 
        }
        //se instancia una variable por cada modelo a utilizar
        $listaDeEspera = new \app\models\Listadeespera();
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

        // Buscamos los capitanes de los equipos disponibles, que tengan lugar para ingresar mas participantes.
        $equipoLista= ArrayHelper::map(\app\models\Equipo::find()
        ->select('COUNT(equipo.idEquipo) AS cantidadCorredores','grupo.idEquipo,equipo.cantidadPersonas,equipo.dniCapitan,')
        ->innerJoin('grupo','equipo.idEquipo=grupo.idEquipo')
        ->groupBy(['equipo.idEquipo'])
        ->having('COUNT(equipo.idEquipo)<equipo.cantidadPersonas')
        ->all(),'idEquipo','dniCapitan');

        // Control que verifica que el usuario este logeado, para ingresar a ésta página
        if(yii::$app->user->isGuest){
            return $this->goHome();
        }
         
        $userLogueado=Yii::$app->user; // Obtenemos el objeto del usuario logeado

        //Renderizamos la página index y le enviamos los modelos necesarios.
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
    /**
     * Busco la carrera donde está inscripto el equipo del DNI ingresado
     * @return array
     */
    public function actionTipocarrera()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0]; //Obtenemos el ID del equipo
                
                // Con ese ID, buscamos el id de la carrera a la que está inscripto el equipo
                $equipo= ArrayHelper::map(\app\models\Equipo::find()->where(['idEquipo' => $idEquipo])->all(),'idEquipo','idTipoCarrera');
                $idTipoCarrera = $equipo[$idEquipo]; //Obtenemos el ID del tipo de la carrera
                // A través de este ID, obtenemos la descripción de la carrera.
                $carrera= ArrayHelper::map(\app\models\Tipocarrera::find()->where(['idTipoCarrera' => $idTipoCarrera])->all(),'idTipoCarrera','descripcionCarrera');
            
                $out = [
                    ['id' => $idTipoCarrera, 'name' => $carrera[$idTipoCarrera]]
                ];
            
            
                return ['output'=>$out, 'selected'=>$idTipoCarrera];
            }
        }
        return ['output'=>'', 'selected'=>''];  
    }

    /**
     * Busco la cantidad de personas que pueden ingresar al equipo del DNI ingresado
     * @return array
     */

    public function actionCantpersonas()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0]; //Obtenemos el ID del equipo
              
                // Con este ID, buscamos cuantas personas pueden ingresar en ese equipo
                $elEquipo= ArrayHelper::map(\app\models\Equipo::find()->where(['idEquipo' => $idEquipo])->all(),'idEquipo','cantidadPersonas');

            
                $out = [
                    ['id' => $idEquipo, 'name' => $elEquipo[$idEquipo]]
                ];
            
            
                return ['output'=>$out, 'selected'=>$idEquipo];
            }
        }
        return ['output'=>'', 'selected'=>''];

    }

    /**
     * Mostramos el nombre y apellido del capitan del equipo creado por el DNI ingresado
     * @return array
     */

    public function actionNombrecapitan()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
           $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idEquipo = $parents[0]; //Obtenemos el ID del equipo

                // Buscamos el equipo a través del DNI ingresado                
                $objEquipo = Equipo::find()->where(['idEquipo'=>$idEquipo])->one();
                $dniCapitan=$objEquipo['dniCapitan'];  //Obtenemos el DNI del capitan del equipo

                // A través del DNI del capitan, buscamos su objeto Usuario
                $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniCapitan])->one();
                $idUsu = $objUsuario['idUsuario']; //Obtenemos el ID del usuario

                // Con el ID del usuario, obtenemos el objeto Persona, para así obtener su nombre y apellido 
                $objPersona = Persona::find()->where(['idUsuario'=>$idUsu])->one();
                $nombrePersona = $objPersona['nombrePersona'];
                $apellidoPersona = $objPersona['apellidoPersona'];
                $nombreCompleto = $nombrePersona . " " . $apellidoPersona; // Concatenamos su nombre y apellido

            
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

        $guardado=false; //Asignamos false a la variable guardado
        $transaction = Persona::getDb()->beginTransaction(); // Iniciamos una transaccion
        $userLogueado=Yii::$app->user;  // Obtenemos el objeto del usuario logeado

        try {
            //Si la gestora ingreasa un corredor
            $idRol = $userLogueado->identity->idRol; // Obtenemos el ID rol del usuario logeado
            if ($idRol == 3 ){ // Si es gestora, implica que va a inscribir a algun corredor que no pudo inscribirse y que no tiene Usuario.
                //Por lo tanto, se crea una tupla nueva en la tabla Usuario

                //MODELO USUARIO
                // Obtenemos los datos recibidos por POST, necesarios para crear la tupla

                $modeloUsuario=Yii::$app->request->post()['Usuario'];
                $dniUsuario = $modeloUsuario['dniUsuario'];

                $modeloPersona=Yii::$app->request->post()['Persona'];
                $mailUsuario = $modeloPersona['mailPersona'];
                $usuario = new Usuario(); // Instanciamos una variable de la clase Usuario y le asignamos los valores
                $usuario->dniUsuario = $dniUsuario;
                $usuario->mailUsuario = $mailUsuario;
                $usuario->activado = 1; // Activado es true, debido a que no hará validación por mail el corredor
                $usuario->idRol = 1; //ID del rol corredor

                $security = new Security();
                //A traves de la funcion generateRandomString, generamos un string aleatorio para completar el campo Authkey
                $authkey = $security->generateRandomString(50);
                $usuario->authkey = $authkey; //clave será utilizada para activar el usuario
                //Encripstamos la clave
                $usuario->claveUsuario = crypt($dniUsuario,Yii::$app->params["salt"]);
                // Buscamos si existe un usuario con este DNI
                $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniUsuario])->One();
                if ($objUsuario == null) { // Es decir, no existe el usuario con ese DNI en la BD
                    $existeUsuario = false;
                } else {
                    $existeUsuario = true;
                }
                

                if ($usuario->validate() && !($existeUsuario)) {
                    // toda la entrada es válida y no existe un usuario con ese DNI
                    $usuario->save(); //Realiza el llenado de la tabla
                    $idUsuario = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
                } else {
                    // la validación falló: $erroresPersonaDireccion es un array que contienen los mensajes de error
                    $usuario = $usuario->errors;
                    
                }

            }else{ 
                // En caso de no ser gestor, obtenemos el ID del usuario corredor que se inscribe normalmente
                $idUsuario=Yii::$app->user->identity->idUsuario;
            }

            //MODELO LOCALIDAD
            $modeloLocalidad=Yii::$app->request->post()['Localidad'];

            //MODELO PERSONA DIRECCION
            // Concatenamos todos los campos relacionados con la Direccion de la persona
            $direccion=Yii::$app->request->post()['calle'].' '.Yii::$app->request->post()['numero'].' '.Yii::$app->request->post()['piso'].' '.Yii::$app->request->post()['departamento'];
            $personaDireccion=new Personadireccion(); //Instanciamos una variable de la clase Persona Direccion
            // Asignamos los valores
            $personaDireccion->idLocalidad=$modeloLocalidad['idLocalidad'];
            $personaDireccion->direccionUsuario=$direccion;
            if ($personaDireccion->validate()) {
                // toda la entrada es válida
                $personaDireccion->save(); //Realiza el llenado de la tabla
                
            } else {
                // la validación falló: $erroresPersonaDireccion es un array que contienen los mensajes de error
                $erroresPersonaDireccion = $personaDireccion->errors;
            }
            
            //MODELO FICHA MEDICA
            $modeloFichaMedica=Yii::$app->request->post()['Fichamedica'];
            $fichaMedica=new Fichamedica(); //Instanciamos una variable de la clase Ficha Medica
            // Asignamos los valores
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
                $fichaMedica->save(); //Realiza el llenado de la tabla
            } else {
                // la validación falló: $erroresFichaMedica es un array que contienen los mensajes de error
                $erroresFichaMedica = $fichaMedica->errors;
            }


            //MODELO PERSONAEMERGENCIA
            $modeloPersonaemergencia=Yii::$app->request->post()['Personaemergencia'];
            $personaEmergencia=new Personaemergencia(); //Instanciamos una variable de la clase Ficha Medica
            // Asignamos los valores
            $personaEmergencia->nombrePersonaEmergencia=$modeloPersonaemergencia['nombrePersonaEmergencia'];
            $personaEmergencia->apellidoPersonaEmergencia=$modeloPersonaemergencia['apellidoPersonaEmergencia'];
            $personaEmergencia->telefonoPersonaEmergencia=$modeloPersonaemergencia['telefonoPersonaEmergencia'];
            $personaEmergencia->idVinculoPersonaEmergencia=$modeloPersonaemergencia['idVinculoPersonaEmergencia'];
            if ($personaEmergencia->validate()) {
                // toda la entrada es válida
                $personaEmergencia->save(); //Realiza el llenado de la tabla
            } else {
                // la validación falló: $erroresPersonaEmergencia es un array que contienen los mensajes de error
                $erroresPersonaEmergencia = $personaEmergencia->errors;
            }

            //Obtenemos el ID del talle de remera seleccionado
            $idTalleRemera=Yii::$app->request->post()['Talleremera']['idTalleRemera'];

            //MODELO PERSONA
            $modeloPersona=Yii::$app->request->post()['Persona'];
            $persona=new Persona(); //Instanciamos una variable de la clase Persona
            // Asignamos los valores

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
            $persona->deshabilitado=0;
            //$persona->estadoPago=null;
            if ($persona->validate()) {
                // toda la entrada es válida
                $persona->save(); //Realiza el llenado de la tabla
            } else {
                // la validación falló: $erroresPersonaEmergencia es un array que contienen los mensajes de error
                $erroresPersona = $persona->errors;
            }
         
            $idPersona=$persona->idPersona;  // Obtenemos el ID de la persona ingresada
          
            //MODELO EQUIPO
            if (!Yii::$app->request->post()['swichtCapitan']){ 
                //Ingresa acá si NO es capitan
                $modeloEquipo=Yii::$app->request->post()['Equipo']['idEquipo'];

                $grupo=new Grupo(); //Instanciamos una variable de la clase Grupo
                // Asignamos los valores
                $grupo->idEquipo=$modeloEquipo;
                $grupo->idPersona=$idPersona;
                $grupo->save(); //Realiza el llenado de la tabla

            }else{
                // Acá ingresa SI es capitan
                $grupo=new Grupo();
                $equipo=new Equipo();
                // Instanciamos una variable de las clases Grupo y Equipo
                // Asignamos los valores
                $cantidadPersonas=Yii::$app->request->post()['Equipo']['cantidadPersonas'];
                $idTipoCarrera=Yii::$app->request->post()['Tipocarrera']['idTipoCarrera'];
                $parametricaCantidadPersonas = ArrayHelper::map(\app\models\Parametros::find()->where(['idParametros' => $cantidadPersonas])->all(),'idParametros','cantidadCorredores');
                // Obtenemos la cantidad de personas que pueden ingresar al grupo
                $equipo->cantidadPersonas=$parametricaCantidadPersonas[$cantidadPersonas];
                // La carrera seleccionada
                $equipo->idTipoCarrera=$idTipoCarrera;
                //El DNI del capitan
                $equipo->dniCapitan=Yii::$app->request->post()['Usuario']['dniUsuario'];
                $equipo->save(); //Realiza el llenado de la tabla
                $idDbEquipo = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del grupo ingresado
                $equipo->nombreEquipo=$idDbEquipo; //Le asignamos como nombre de equipo, el ID del grupo
                $equipo->update(); //Actualizamos la tupla
                $grupo->idEquipo=$idDbEquipo;
                $grupo->idPersona=$idPersona;
                $grupo->save(); //Realiza el llenado de la tabla

            }

            //MODELO CARRERAPERSONA
            
            $modeloCarreraPersona = Yii::$app->request->post()['Carrerapersona'];
            
            if (!Yii::$app->request->post()['swichtCapitan']){ //Si no es capitan
                $idEquipo=Yii::$app->request->post()['Equipo']['idEquipo']; //Obtenemos el ID equipo
                
                $objEquipo = Equipo::find()->where(['idEquipo'=>$idEquipo])->one(); //Obtenemos el obj equipo
                $idTipoCarrera=$objEquipo['idTipoCarrera']; // Obtenemos el ID del tipo carrera que se inscribió el equipo
            }

            // Instanciamos una variable de la clase Carrera Persona
            // Asignamos los valores
            $carreraPersona = new Carrerapersona();
            $carreraPersona->idPersona=$idPersona;
            $carreraPersona->idTipoCarrera = $idTipoCarrera;
            $carreraPersona->reglamentoAceptado = $modeloCarreraPersona['reglamentoAceptado'];
            $carreraPersona->save(); //Realiza el llenado de la tabla
            
            // Obtenemos la cantidad de inscriptos
            // Si la cantidad de personas inscriptas es mayor A XXXXXXXXXXXXXX, se agrega a lista de espera:
            $cantidadInscriptos = Persona::find()->where(['deshabilitado'=>0])->count();
            $cantidadMaxInscriptos = 15;
            if ($cantidadInscriptos>$cantidadMaxInscriptos){
                 $listaDeEspera = new Listadeespera();
                 $listaDeEspera->idPersona=$idPersona;
                 $listaDeEspera->save(); // Realiza el llenado de la tabla
            }

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
            //Si se realiza el commit, asigna true a la variable guardado
            $transaction->commit();
            $guardado=true;
            if ($guardado){     // Si la inscripcion es guardada correctamente, se envia un mail de confirmacion 

                // Obtenemos el Objeto usuario para obtener sus dato
                $objUsuario=Usuario::find()->where(['idUsuario'=>$idUsuario])->one();
                $objPersona=Persona::find()->where(['idUsuario'=>$idUsuario])->one();
                $nombrePersona = $objPersona->nombrePersona;
                $apellidoPersona = $objPersona->apellidoPersona;
                $mailUsuario = $objUsuario->mailUsuario;

                //mail de confirmacion de inscripcion
                $subject = "Inscripcion y reglamento"; // Asunto del mail
                // Cuerpo del mail
                $body = "<h1>Carrera por Bardas</h1><br><h2>Gracias por inscribirse a la carrera ". $nombrePersona . " " . $apellidoPersona .". </h2> <br/>".
                "<h2> Podes ver los terminos y condiciones que has aceptado en el siguiente enlace: </h2>". 
                "<h2><a href='http://localhost/carrera/web/index.php'>Reglamento</a></h2><br>".
                "<h1>Carrera por Bardas</h1><br>".
                "<a href='www.facebook.com'><img src='facebook.png' alt='fb'></a><br>".
                "Este mensaje de correo electrónico se envió a ".$mailUsuario;
        

                Yii::$app->mailer->compose()
                    ->setFrom('carreraxbarda@gmail.com')
                    //->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['title']])
                    ->setTo($mailUsuario)
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



    }

    public function actionExistedni()
    {
        $parents =Yii::$app->request->get();
        $existeUsuario=1;
        if(isset($parents['dniUsuario'])){
            $dniUsuario = $parents['dniUsuario'];

             $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniUsuario])->one();
            if ($objUsuario<>null){
                $idUsuario = $objUsuario->idUsuario;
                $objPersona = Persona::find()->where(['idUsuario'=>$idUsuario])->one();
                if ($objPersona<>null){
                    $existeUsuario = 1;
                } else {
                    $existeUsuario = 0;
                }
                
            } else {
                $existeUsuario = 0;
            }
           
          
        }
        return $existeUsuario;
    }
    /**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = '/main2';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}


