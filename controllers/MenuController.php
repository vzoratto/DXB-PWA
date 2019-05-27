<?php

namespace app\controllers;


namespace app\controllers;

use Yii;
use app\models\Localidad;
use app\models\Persona;
use app\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class MenuController extends Controller {

    public function veremosExcel() {
        
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all Persona models.
     * @return mixed
     */
    public function actionIndex() {

//Yii::$app->response->sendFile();


        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persona model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Persona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPersona]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idPersona]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExcel() {
        
        
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $file = \Yii::createObject([
                    'class' => 'codemix\excelexport\ExcelFile',
                    'sheets' => [
                        'Users' => [
                            'class' => 'codemix\excelexport\ActiveExcelSheet',
                            'query' => Persona::find(),
                        ]
                    ]
        ]);
        $file->send('user.xlsx');
        exit();
        /*
     $file = \Yii::createObject([
    'class' => 'codemix\excelexport\ExcelFile',
    'writerClass' => '\PHPExcel_Writer_Excel5', // Override default of `\PHPExcel_Writer_Excel2007`

    'sheets' => [

        'Active Users' => [
            'class' => 'codemix\excelexport\ActiveExcelSheet',
            'query' => Persona::find()->where(['active' => true]),

            // If not specified, all attributes from `User::attributes()` are used
            'attributes' => [
                'idPersona',
                'idTalleRemera',
                'dniCapitan',
                'nombrePersona',
                'apellidoPersona',
               // 'team.name',    // Related attribute
               // 'created_at',
            ],

            // If not specified, the label from the respective record is used.
            // You can also override single titles, like here for the above `team.name`
            'titles' => [
                'D' => 'Team Name',
            ],
        ],

    ],
]);
$file->send('demo.xlsx');
        */
    }

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
