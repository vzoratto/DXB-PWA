<?php

namespace app\controllers;

use app\models\Gestores;
use app\models\User;
use Yii;
use app\models\Equipo;
use app\models\EquipoSearch;
use app\models\Carrerapersona;
use app\models\Usuario;
use app\models\Persona;
use app\models\Grupo;
use app\models\CambiaCapitanForm;
use app\models\CambiaCorredorForm;
use app\models\Permiso;
use app\models\Estadopagoequipo;
use app\models\Tipocarrera;
use app\models\Grupocopia;
use app\models\Carrerapersonacopia;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EquipoController implements the CRUD actions for Equipo model.
 */
class EquipoController extends Controller
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
     * Lists all Equipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $gestor=Gestores::findOne(['idUsuario' => $_SESSION['__id']]);

        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
        if($gestor==null){//si el usuario logueado no es gestor//lo redirecciono al home
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere(['equipo.deshabilitado' =>0]);//Poner condicion al dataprovider para que traiga los equipos habilitados
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHabilitados(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $gestor=Gestores::findOne(['idUsuario' => $_SESSION['__id']]);

        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
        if($gestor==null){//si el usuario logueado no es gestor//lo redirecciono al home
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $searchModel = new EquipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['equipo.deshabilitado' =>0]);//Poner condicion al dataprovider para que traiga los equipos habilitados
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Equipo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout='/main3';

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Equipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Equipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEquipo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Equipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idEquipo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Equipo model.
     * Valida datos del form cambia capitan.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionValidacap()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
       $model=new CambiaCapitanForm;
        if ($model->load(Yii::$app->request->post())){ 
               if($equipo=Equipo::findOne(['dniCapitan'=>$model->dniCapitan])){//verifica que exista el dni capitan
                   if($estadopago=Estadopagoequipo::findOne(['idEquipo'=>$equipo->idEquipo])){//verifica el pago del equipo
                       //verifica capitan del equipo
                       $usuario=Usuario::findOne(['dniUsuario'=>$equipo->dniCapitan]);
                       $persona=Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
                       $carreraper=Carrerapersona::findOne(['idPersona'=>$persona->idPersona]);
                       $grupo=Grupo::findOne(['idPersona'=>$persona->idPersona]);
                       $tipocarrera=Tipocarrera::findOne(['idTipoCarrera'=>$carreraper->idTipoCarrera]);
                      //verifica el usuario reemplazante
                       if($usuario1=Usuario::findOne(['dniUsuario'=>$model->dniUsuario])){
                             if($persona1=Persona::findOne(['idUsuario'=>$usuario1->idUsuario])){
                                 if($grupo1=Grupo::findOne(['idPersona'=>$persona1->idPersona])){
                                     $equipo1=Equipo::findOne(['idEquipo'=>$grupo1->idEquipo]);       
                                    return $this->render('verifica',[//renderiza si  existe en un grupo
                                             'usuario'=>$usuario,
                                             'equipo'=>$equipo,
                                             'persona'=>$persona,
                                             'carreraper'=>$carreraper,
                                             'grupo'=>$grupo,
                                             'tipocarrera'=>$tipocarrera,
                                             'usuario1'=>$usuario1,
                                             'persona1'=>$persona1,
                                             'grupo1'=>$grupo1,
                                             'equipo1'=>$equipo1,
                                       ]);
                                 }else{
                                    return $this->render('verifica',[//renderiza si no existe en un grupo
                                        'usuario'=>$usuario,
                                        'equipo'=>$equipo,
                                        'persona'=>$persona,
                                        'carreraper'=>$carreraper,
                                        'grupo'=>$grupo,
                                        'tipocarrera'=>$tipocarrera,
                                        'usuario1'=>$usuario1,
                                        'persona1'=>$persona1,
                                        'grupo1'=>null,
                                        'equipo1'=>null,
                                    ]);
                                 }
                             }else{
                                Yii::$app->session->setFlash('per1FormSubmitted');
                                return $this->refresh();//no tiene inscripcion usuario
                             }
                       }else{
                           Yii::$app->session->setFlash('usu1FormSubmitted');
                           return $this->refresh();//no existe el usuario
                       }
                   }else{
                       Yii::$app->session->setFlash('estadoFormSubmitted');
                       return $this->refresh();//no pago la inscripcion
                   }
                }else{
                      Yii::$app->session->setFlash('capFormSubmitted');
                      return $this->refresh();//no existe el capitan
                }
        }
        return $this->render('cambia', [//renderiza al formulario
            'model' => $model,  
        ]);
    }
    /**
     * Updates an existing Equipo model.
     * Cambia capitan con los datos verificados de actionValidacap.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCambiacap()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $mensaje="";
        $transaction = Yii::$app->getDb()->beginTransaction(); // Iniciamos una transaccion
        try{
              if($model=Yii::$app->request->get()){ 
               $capitan = $model['1'];
               $idPercap=$model['2'];
               $participante = $model['3'];
               $idPerusu=$model['4'];
                
                  $grupo=Grupo::findOne(['idPersona'=>$idPercap]);//aca se borra
                  $grupocopia=new Grupocopia;
                  $grupocopia->idEquipo=$grupo->idEquipo;
                  $grupocopia->idPersona=$grupo->idPersona;
                  $grupocopia->save();//salva el cambio del capitan en grupocopia
                  $grup=Grupo::deleteAll(['idPersona'=>$grupo->idPersona]);
                  $carreraper=Carrerapersona::findOne(['idPersona'=>$idPercap]);//aca se borra
                  $carreracopia=new Carrerapersonacopia;
                  $carreracopia->idTipoCarrera=$carreraper->idTipoCarrera;
                  $carreracopia->idPersona=$carreraper->idPersona;
                  $carreracopia->save();//salva el cambio del capitan en carrerapersonacopia
                  Carrerapersona::deleteAll(['idPersona' =>$carreraper->idPersona]);

                  $equipo=Equipo::findOne(['dniCapitan'=>$capitan]);//aca se cambia
                  $equipo->dniCapitan=$participante;
                  if($equipo->save()){
                  $transaction->commit();
                  $mensaje="Perfecto, se realizó el cambio de capitán";//salva cambio capitan
                  }else{
                    $transaction->rollBack();
                    $mensaje="No se pudo realizar el cambio";
                  }
                  return $this->render('aviso',[
                     'capitan'=>$capitan,
                     'participante'=>$participante,
                     'equipo'=>$equipo,
                     'mensaje'=>$mensaje,
                  ]);
                }else{
                    $mensaje="No se pudo realizar el cambio";
                   
                    return $this->render('aviso',[
                        'capitan'=>$capitan,
                        'participante'=>$participante,
                        'equipo'=>$equipo,
                        'mensaje'=>$mensaje,
                    ]);
                } 
        } catch(\Exception $e) {//atrapa el error
             $transaction->rollBack();
             throw $e;
         }   
    }
/**
     * Updates an existing Equipo model.
     * Valida datos del form cambia corredor.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionValidacorredor()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
       $model=new CambiaCorredorForm;
        if ($model->load(Yii::$app->request->post())){
            //verifica corredor del equipo 
               if($usuario=Usuario::findOne(['dniUsuario'=>$model->dniCorredor])){
                 $persona=Persona::findOne(['idUsuario'=>$usuario->idUsuario]);
                 if($grupo=Grupo::findOne(['idPersona'=>$persona->idPersona])){
                    $equipo=Equipo::findOne(['idEquipo'=>$grupo->idEquipo]);//verifica que exista el idEquipo
                    if($estadopago=Estadopagoequipo::findOne(['idEquipo'=>$equipo->idEquipo])){//verifica el pago del equipo 
                       $carreraper=Carrerapersona::findOne(['idPersona'=>$persona->idPersona]); 
                       $tipocarrera=Tipocarrera::findOne(['idTipoCarrera'=>$carreraper->idTipoCarrera]);
                      //verifica el usuario reemplazante    
                                    return $this->render('verificacorredor',[//renderiza si  existe en un grupo
                                             'usuario'=>$usuario,
                                             'equipo'=>$equipo,
                                             'persona'=>$persona,
                                             'carreraper'=>$carreraper,
                                             'grupo'=>$grupo,
                                             'tipocarrera'=>$tipocarrera,
                                       ]);
                   }else{
                       Yii::$app->session->setFlash('estadoFormSubmitted');
                       return $this->refresh();//no pago la inscripcion
                   }
                 }else{
                    Yii::$app->session->setFlash('corredorFormSubmitted');
                    return $this->refresh();//no existe el corredor 
                 }
               }else{
                   Yii::$app->session->setFlash('usuarioFormSubmitted');
                   return $this->refresh();//no existe el usuario 
               }
        }
        return $this->render('cambiacorredor', [//renderiza al formulario
            'model' => $model,  
        ]);
    }
    /**
     * Updates an existing Equipo model.
     * Cambia corredor con los datos verificados de actionValidacorredor.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCambiacorredor()
    {
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $mensaje="";
              if($model=Yii::$app->request->get()){ 
               $corredor = $model['1'];//dniUsuario corredor
               $idPercorredor=$model['2'];//idPersona corredor
               
                  $grupo=Grupo::findOne(['idPersona'=>$idPercorredor]);
                  $grupocopia=new GrupoCopia;
                  $grupocopia->idEquipo=$grupo->idEquipo;
                  $grupocopia->idPersona=$grupo->idPersona;
                  $grupocopia->save();//salva el cambio del capitan en grupo
                  $grupo=Grupo::deleteAll(['idPersona'=>$idPercorredor]);
                  $carreraper=Carrerapersona::findOne(['idPersona'=>$idPercorredor]);
                  $carreracopia=new Carrerapersona;
                  $carreracopia->idTipoCarrera=$carreraper->idTipocarrera;
                  $carreracopia->idPersona=$carreraper->idPersona;
                  $carreracopia->save();//salva el cambio del capitan en carrerapersona
                  $carreraper=Carrerapersona::deleteAll(['idPersona'=>$idPercorredor]);
                  $mensaje="Perfecto, se realizó la desafectación del corredor.";//salva cambio capitan
                   
                   return $this->render('avisocorredor',[//renderiza aviso del cambio
                      'corredor'=>$corredor,
                      'grupocopia'=>$grupocopia,
                      'mensaje'=>$mensaje,
                     ]);
                }else{
                    $mensaje="No se pudo realizar la desafectación del corredor.";
                   
                    return $this->render('avisocorredor',[
                        'corredor'=>$corredor,
                        'grupocopia'=>$grupocopia,
                        'mensaje'=>$mensaje,
                    ]);
                }//fin control get    
    }
    /**
     * Deletes an existing Equipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $equipo = Equipo::findOne($id);
        $tipocarrera=Tipocarrera::findOne(['idTipoCarrera'=>$equipo->idTipoCarrera]);
        $grupo=Grupo::find()->Select('idPersona')->where(['idEquipo'=>$equipo->idEquipo])->all();
       echo '<pre>'; print_r($grupo);echo '</pre>';die();
        foreach($grupo as $persona){
            $grupocopia=new Grupocopia;
            $grupocopia->idEquipo=$persona->idEquipo;
            $grupocopia->idPersona=$persona->idPersona;
            $grupocopia->save();//copia grupo
            $grup=Grupo::findOne($persona->idEquipo,$persona->idPersona)->delete();
            $carreracopia=new Carreracopia;
            $carreracopia->idTipoCarrera=$tipocarrera->idTipocarrera;
            $carreracopia->idPersona=$persona->idPersona;
            $carreracopia->save();//copia carrera persona
            $carr=Carrerapersona::findOne($tipocarrera->idTipocarrera,$persona->idPersona)->delete();
            $persona->deshabilitado=1;//deshabilita persona
            $persona->save();
            $equipo->deshabilitado=1;//deshabilita equipo
            $equipo->save();
        }

        return $this->redirect(['estadopagoequipo/index1']);
    }

    /**
     * Finds the Equipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionInvitados(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $gestor=Gestores::findOne(['idUsuario' => $_SESSION['__id']]);

        if(Persona::findOne(['idUsuario' => $_SESSION['__id']])){
            return $this->goHome();
        }
        if($gestor==null){//si el usuario logueado no es gestor//lo redirecciono al home
            return $this->goHome();
        }
        if(Permiso::requerirRol('administrador')){
            $this->layout='/main2';
        }elseif(Permiso::requerirRol('gestor')){
            $this->layout='/main3';
        }
        $equipos=Equipo::findAll(['deshabilitado'=>0]);
        $equiposInvitados=[];
        foreach ($equipos as $equipo){
            if($equipo->invitado()==true){
                $equiposInvitados[]=$equipo;
            }

        }
        //equipos invitados
        $dataProvider=new ArrayDataProvider([
            'allModels'=>$equiposInvitados
        ]);


        $searchModel = new EquipoSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere(['equipo.deshabilitado' =>0]);//Poner condicion al dataprovider para que traiga los equipos habilitados

        return $this->render('invitados',['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]);

    }
}
