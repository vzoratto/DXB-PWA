<?php

namespace app\controllers;

use app\models\Equipo;
use app\models\Gestores;
use app\models\Usuario;
use Yii;
use app\models\Result;
use app\models\ResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultController implements the CRUD actions for Result model.
 */
class ResultController extends Controller
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
     * Lists all Result models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $usuarioLogin=Usuario::findOne(['idUsuario' => $_SESSION['__id']]);

        $gestor=Gestores::findOne(['idUsuario' => $_SESSION['__id']]);
        if($usuarioLogin->idRol!=2){
            return $this->goHome();
        }

        if($gestor==null){//si el usuario logueado no es gestor//lo redirecciono al home
            return $this->goHome();
        }
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Result model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idResultado]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Result model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idResultado]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Result model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Result::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCargar(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $usuarioLogin=Usuario::findOne(['idUsuario' => $_SESSION['__id']]);

        $gestor=Gestores::findOne(['idUsuario' => $_SESSION['__id']]);
        if($usuarioLogin->idRol!=2){
            return $this->goHome();
        }

        if($gestor==null){//si el usuario logueado no es gestor//lo redirecciono al home
            return $this->goHome();
        }
        $this->layout='main2';
        return $this->render('cargar');
    }
    public function actionProcesar(){

        $json=$_POST['archivo'];
        $data = json_decode($json, TRUE);
        $guardados=0;
        $noGuardados=0;
        foreach($data as $dat){
            $resultadDelEquipo=Result::findOne(['numEquipo'=>$dat['numEquipo']]);

            //si no existe el equipo en la base se carga
            if(!$resultadDelEquipo){

                $equipo=Equipo::findOne(['nombreEquipo'=>$dat['numEquipo']]);
                if($equipo){
                    $resultado=new Result();
                    $resultado->numEquipo=$dat['numEquipo'];
                    $resultado->tiempoLlegada=$dat['tiempoLlegada'];
                    $resultado->respuestasCorrectas=$dat['respuestasCorrectas'];
                    $resultado->bolsasCompletas=$dat['bolsasCompletas'];
                    $resultado->categoria=$equipo->idTipoCarrera;
                    $resultado->cantPersonas=$equipo->cantidadPersonas;
                    //$resultado->cumplioRequisitoTrivia();
                    $resultado->penalidad();
                    $guardados++;

                    $final = $resultado->total / 1000;
                    $llegada = $resultado->tiempoLlegada / 1000;
                    $PenalidadTrivia=$resultado->trivia / 1000;
                    $penalidadBolsa=$resultado->penalizacionBolsa/1000;
                    echo 'equipo'.$resultado['numEquipo'] .'Tiempo LLegada'.  date("H:i:s", $llegada) .'Penalidad Trivia '.date("H:i:s", $PenalidadTrivia) .'Penalidad Bolsa'.date("H:i:s", $penalidadBolsa).'Tiempo Final'.date("H:i:s", $final);
                    echo '<hr>';
                    //echo 'equipo-'. $dat['numEquipo']. '-Trivias-'. var_dump($resultado->cumplioRequisitoTrivia());
                    //echo '<hr>';
                    //echo 'equipo-'.$dat['numEquipo'].'-Bolsas-'. var_dump($resultado->cumplioRequisitoBolsa());
                    //die();
                    //$resultado->save();
                    //print_r($resultado->errors);
                }else{
                    echo ' no existe el equipo error';
                }

            }
            $noGuardados++;
            //$guardados=$guardados+1;
            //echo $guardados;
        }

        echo 'cargados Corectamente '. $guardados;
        echo '<hr>';
        //echo 'No cargados '. $noGuardados;
    }

    public function actionResultados(){

        //$resultados=Result::find()->orderBy(['total'=>SORT_ASC])->all();
        //$resultadoss=Result::find();
        $tipoCarrera=null;
        $cantPersonas=null;
        $resultados=Result::find()->where(['categoria'=>1])->andFilterWhere(['cantPersonas'=>2])->orderBy(['total'=>SORT_ASC])->all();
            if(isset($_GET['tipoCarrera'])){
                if($_GET['tipoCarrera']==2 or $_GET['tipoCarrera']==1){
                    $tipoCarrera=$_GET['tipoCarrera'];
                    if($_GET['cantPersonas']){
                        $cantPersonas=$_GET['cantPersonas'];
                        $resultados=Result::find()->where(['categoria'=>$tipoCarrera])->andFilterWhere(['cantPersonas'=>$cantPersonas])->orderBy(['total'=>SORT_ASC])->all();

                    }

                }else{
                    $resultados=Result::find()->orderBy(['total'=>SORT_ASC])->all();


                }
            }




        return $this->render('result',['resultados'=>$resultados,'tipoCarrera'=>$tipoCarrera,'cantPersonas'=>$cantPersonas]);

    }

    public function actionIndividual(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        $usuarioLogin=Usuario::findOne(['idUsuario' => $_SESSION['__id']]);

        $gestor=Gestores::findOne(['idUsuario' => $_SESSION['__id']]);
        if($usuarioLogin->idRol!=2){
            return $this->goHome();
        }

        if($gestor==null){//si el usuario logueado no es gestor//lo redirecciono al home
            return $this->goHome();
        }
        $this->layout='main2';
        return $this->render('individual');
    }

    public function actionProcesarindividual(){
        $guardados=0;
        $noGuardados=0;
        $numEquipo=Yii::$app->request->post()['numEquipo'];
        $tiempoLlegada=Yii::$app->request->post()['tiempoLlegada'];
        $respuestasCorrectas=Yii::$app->request->post()['respuestasCorrectas'];
        $bolsasCompletas=Yii::$app->request->post()['bolsasCompletas'];
        $resultadDelEquipo=Result::findOne(['numEquipo'=>$numEquipo]);

        //si no existe el equipo en la base se carga
        if(!$resultadDelEquipo){

            $equipo=Equipo::findOne(['nombreEquipo'=>$numEquipo]);
            if($equipo){
                $resultado=new Result();
                $resultado->numEquipo=$numEquipo;
                $resultado->tiempoLlegada=$tiempoLlegada;
                $resultado->respuestasCorrectas=$respuestasCorrectas;
                $resultado->bolsasCompletas=$bolsasCompletas;
                $resultado->categoria=$equipo->idTipoCarrera;
                $resultado->cantPersonas=$equipo->cantidadPersonas;
                //$resultado->cumplioRequisitoTrivia();
                $resultado->penalidad();
                $guardados++;

                $final = $resultado->total / 1000;
                $llegada = $resultado->tiempoLlegada / 1000;
                $PenalidadTrivia=$resultado->trivia / 1000;
                $penalidadBolsa=$resultado->penalizacionBolsa/1000;
                echo 'equipo'.$resultado['numEquipo'] .'Tiempo LLegada'.  date("H:i:s", $llegada) .'Penalidad Trivia '.date("H:i:s", $PenalidadTrivia) .'Penalidad Bolsa'.date("H:i:s", $penalidadBolsa).'Tiempo Final'.date("H:i:s", $final);
                echo '<hr>';
                //echo 'equipo-'. $dat['numEquipo']. '-Trivias-'. var_dump($resultado->cumplioRequisitoTrivia());
                //echo '<hr>';
                //echo 'equipo-'.$dat['numEquipo'].'-Bolsas-'. var_dump($resultado->cumplioRequisitoBolsa());
                //die();
                //$resultado->save();
                //print_r($resultado->errors);
            }else{
                echo ' no existe el equipo error';
            }

        }
        $noGuardados++;
        //$guardados=$guardados+1;
        //echo $guardados;
        echo 'cargados Corectamente '. $guardados;
        echo '<hr>';
        //echo 'No cargados '. $noGuardados;



    }
}
