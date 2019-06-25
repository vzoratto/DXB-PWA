<?php

namespace app\controllers;

use Yii;
use app\models\Gestores;
use app\models\GestoresSearch;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\base\Security; 

/**
 * GestoresController implements the CRUD actions for Gestores model.
 */
class GestoresController extends Controller
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
     * Lists all Gestores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '/main2';
        $searchModel = new GestoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gestores model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = '/main2';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gestores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = '/main2';
        $model = new Gestores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idGestor]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gestores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = '/main2';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idGestor]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gestores model.
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
     * Finds the Gestores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gestores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gestores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     /**
     * Buscar roles administrador.
     * @return mixed
     * 
     */
    public function actionBusadmin(){
        $this->layout='/main2';
        $model = new Gestores();
        $dataProvider = $model->Adminbusquedas(); //la consulta se genera en el modelo
        $rol='admin';
        return $this->render('index1',[
            'model' => $model,
            'dataProvider' => $dataProvider,
            'rol'=> $rol,
          ]);
     }
     /**
     * Busca roles gestor.
     * @return mixed
     * 
     */
     public function actionBusgestor(){
        $this->layout='/main2';
        $model = new Gestores();
        $dataProvider = $model->Gestorbusquedas(); //la consulta se genera en el modelo
        $rol='gest';
        return $this->render('index1',[
            'model' => $model,
            'dataProvider' => $dataProvider,
            'rol'=> $rol,
          ]);
     }
     /**
     * Dar alta administrador.
     * @return mixed
     * 
     */
     public function actionAltaadmin(){
        $this->layout='/main2';
        $model = new \app\models\Gestores(); //Instanciamos una variable
        $model1 = new \app\models\Usuario(); //Instanciamos una variable
        $rol='admin';
        return $this->render('altagestores', [
            'model' => $model,
            'model1' => $model1,
            'rol'=> $rol,
        ]);
    }
     /**
     * Dar alta gestor.
     * @return mixed
     * 
     */
    public function actionAltagestor(){
        $this->layout='/main2';
        $model = new \app\models\Gestores(); //Instanciamos una variable
        $model1 = new \app\models\Usuario(); //Instanciamos una variable
        $rol='gest';
        return $this->render('altagestores', [
            'model' => $model,
            'model1' => $model1,
            'rol'=> $rol,
        ]);
    }

     /**
     * Guarda los datos del formulario en sus correspondientes tablas de la base de datos
     */
    public function actionCargagestores(){
        $idUsuario='';
        $guardado=false; //Asignamos false a la variable guardado
        $transaction = Gestores::getDb()->beginTransaction(); // Iniciamos una transaccion
        try {
                //MODELO USUARIO
                // Obtenemos los datos recibidos por POST

                $modeloUsuario=Yii::$app->request->post()['Usuario'];
                
                $dniUsuario = $modeloUsuario['dniUsuario'];
                $mailUsuario = $modeloUsuario['mailUsuario'];
                $usuario = new Usuario(); // Instanciamos una variable de la clase Usuario y le asignamos los valores
                $usuario->dniUsuario = $dniUsuario;
                $usuario->mailUsuario = $mailUsuario;
                $usuario->activado = 1; // Activado es true, debido a que no hará validación por mail el corredor
                $usuario->idRol =$modeloUsuario['idRol'];
               // $usuario->idRol = 1; //ID del rol corredor

                $security = new Security();
                //A traves de la funcion generateRandomString, generamos un string aleatorio para completar el campo Authkey
                $authkey = $security->generateRandomString(50);
                $usuario->authkey = $authkey; //clave será utilizada para activar el usuario
                $usuario->claveUsuario = crypt($usuario->dniUsuario, Yii::$app->params["salt"]);//Encriptamos la clave
                // Buscamos si existe un usuario con este DNI
                $objUsuario = Usuario::find()->where(['dniUsuario'=>$dniUsuario])->One();
                if ($objUsuario == null) { // Es decir, no existe el usuario con ese DNI en la BD
                    $existe = false;
                } else {
                    $existe = true;
                }
                
                if ($usuario->validate() && !$existe) {
                   
                    // toda la entrada es válida y no existe un usuario con ese DNI
                    $usuario->save(); //Realiza el llenado de la tabla
                   
                    $idUsuario = Yii::$app->db->getLastInsertID(); //Obtenemos el ID del ultimo usuario ingresado
                } else {
                    // la validación falló: $erroresusuarioerror es un array que contienen los mensajes de error
                    $usuario = $usuario->errors;
                    
                }
                //echo '<pre>';echo $existe;print_r($usuario);echo'</pre>';

            //MODELO GESTORES
            $modeloGestores=Yii::$app->request->post()['Gestores'];
            $gestor=new Gestores(); //Instanciamos una variable de la clase Gestores
            // Asignamos los valores
            $gestor->nombreGestor=$modeloGestores['nombreGestor'];
            $gestor->apellidoGestor=$modeloGestores['apellidoGestor'];
            $gestor->telefonoGestor=$modeloGestores['telefonoGestor'];
            $gestor->idUsuario=$idUsuario;
            if ($gestor->validate()) {
                // toda la entrada es válida
                $gestor->save(); //Realiza el llenado de la tabla
            } else {
                // la validación falló: $erroresgestorerror es un array que contienen los mensajes de error
                $erroresGestor = $gestor->errors;
            }
            //Si se realiza el commit, asigna true a la variable guardado
            $transaction->commit();
            $guardado=true;
            if ($guardado){     // Si el alta es guardada correctamente, se envia un mail de confirmacion 
                return $this->redirect(['index']);
            }else{
                //$mensaje = "Ha ocurrido un error al llevar a cabo tu inscripcion,vuelve a intentarlo";
                return $this->redirect(['index']);
            }
        } catch(\Exception $e) {
            $guardado=false;
            $transaction->rollBack();
            throw $e;
        }
    }
}
