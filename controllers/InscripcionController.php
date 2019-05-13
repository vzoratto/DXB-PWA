<?php

namespace app\controllers;

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
     * Lists all Gruposanguineo models.
     * @return mixed
     */
    public function actionIndex()
    {

        $persona = new \app\models\Persona(); //Instanciamos una variable
        $usuario = new \app\models\Usuario(); //Instanciamos una variable
        $personaDireccion = new \app\models\Personadireccion(); //Instanciamos una variable
        $fichaMedica = new \app\models\Fichamedica(); //Instanciamos una variable
        $datosEmergencia = new \app\models\Personaemergencia();
        return $this->render('index',['persona'=>$persona,'usuario'=>$usuario,'personaDireccion'=>$personaDireccion,'fichaMedica'=>$fichaMedica,'datosEmergencia'=>$datosEmergencia]);
    }


    public function actionContactoemergencia()
    {
        $model = new \app\models\Personaemergencia(); //Instanciamos una variable

        return $this->render('contactoemergencia', [
            'model' => $model,
        ]);
    }
    
    
    public function actionDatoscontacto()
    {

        $personaDireccion = new \app\models\Personadireccion(); //Instanciamos una variable
        $persona= new \app\models\Persona(); //Instanciamos una variable

        return $this->render('datoscontacto', [
            'personaDireccion' => $personaDireccion,
            'persona' => $persona,
        ]);
    }
    
    
    public function actionDatosmedicos()
    {

        $model = new \app\models\Fichamedica(); //Instanciamos una variable

        return $this->render('datosmedicos', [
            'model' => $model,
        ]);
    }
    
    
    public function actionDatospersonales()
    {

        $model = new \app\models\Persona(); //Instanciamos una variable
        $model1 = new \app\models\Usuario(); //Instanciamos una variable

        return $this->render('datospersonales', [
            'model' => $model,
            'model1' => $model1,
        ]);
    }


    public function actionEncuesta()
    {

        $model = new \app\models\Encuesta(); //Instanciamos una variable

        return $this->render('encuesta', [
            'model' => $model,
        ]);
    }

    public function actionStore(){
        print_r(Yii::$app->request->post());

        die();
    }
    
}
