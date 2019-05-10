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

        return $this->render('index');
    }


    public function actionContactoemergencia()
    {

        return $this->render('contactoemergencia');
    }
    
    
    public function actionDatoscontacto()
    {

        return $this->render('datoscontacto');
    }
    
    
    public function actionDatosmedicos()
    {

        return $this->render('datosmedicos');
    }
    
    
    public function actionDatospersonales()
    {

        return $this->render('datospersonales');
    }


    public function actionEncuesta()
    {

        return $this->render('encuesta');
    }
    
}
