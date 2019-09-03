<?php
/**
 * Created by PhpStorm.
 * User: ariel
 * Date: 02/09/19
 * Time: 12:53
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Gruposanguineo;
use app\models\Talleremera;
use app\models\Tipocarrera;
use app\models\Carrerapersona;
use app\models\Usuario;
use app\models\Persona;
use app\models\Estadopagopersona;
use app\models\Estadopago;
use dimmitri\grid\ExpandRowColumn;
use kartik\export\ExportMenu;
use yii\widgets\ActiveForm;
use buttflattery\formwizard\FormWizard;
$this->title = 'Equipos Invitados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index reglamento-container">


    <h1>Total de Equipos Invitados: <?= Html::encode($dataProvider->getCount()) ?> </h1>
    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        [   'label' => 'Nombre Equipo',
            'class' => ExpandRowColumn::class,
            'attribute' => 'nombreEquipo',
            'value' => function($model) {
                return ($model->nombreEquipo);
            },
            'column_id' => 'column-info',
            'url' => Url::to(['view']),
            'submitData' => function ($model, $key, $index) {
                return ['id' => $model->idEquipo, 'advanced' => true];
            },
        ],

        'dniCapitan',
        ['label'=>'Cantidad de Corredores',
            'attribute'=>'cantidadPersonas',
            'value'=> function($model){
                return($model->cantidadPersonas);
            }
        ],
        ['label' => 'Tipo de Carrera',
            'attribute' => 'idTipoCarrera',
            'value' => function($model) {
                return ($model->tipoCarrera->descripcionCarrera);
            },
            'filter' => ArrayHelper::map(Tipocarrera::find()->asArray()->all(), 'idTipoCarrera', 'descripcionCarrera')
        ],
        ['label' => 'Habilitado',
            'attribute' => 'deshabilitado',
            'value' => function($model) {

                return ($model->deshabilitado==0)?"si":"no";
            },
            'filter' => array("0"=>"si","1"=>"no")
        ],
    ];
    // Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'filename'=>'DesafioBardas',
        'target' => ExportMenu::TARGET_SELF,

        'hiddenColumns'=>[0, 1],
        'exportConfig' => [
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_EXCEL => false,
            ExportMenu::FORMAT_PDF => [
                'pdfConfig' => [
                    'methods' => [
                        'SetTitle' => 'Desafio Bardas',
                        'SetHeader' => ['Desafio Bardas||Generado: ' . date("r")],
                        'SetFooter' => ['|Pagina {PAGENO}|'],
                    ]
                ]
            ],

        ],
        'dropdownOptions' => [
            'label' => 'Exportar',
            'class' => 'btn btn-secondary'
        ]


    ]);
    // You can choose to render your own GridView separately
    echo \kartik\grid\
    GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => $gridColumns
        ]);
    ?>




</div>
