<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Persona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idPersona',
            //'idTalleRemera',
            'nombrePersona',
            'apellidoPersona',
            'fechaNacPersona',
            //'sexoPersona',
            //'nacionalidadPersona',
            //'telefonoPersona',
            //'mailPersona',
            [ 'label'=>'DNI',
                'attribute' => 'idUsuario',
                 'value' => function($model) {
                     return ($model->usuario->dniUsuario);
                 },
                //'filter' => ArrayHelper::map(Usuario::find()->asArray()->all(), 'idUsuario', 'dniUsuario')
                
               ],
                 //'idPersonaDireccion',
            //'idFichaMedica',
            'fechaInscPersona',
            //'idPersonaEmergencia',
            //'idResultado',
            //'donador',
            //'deshabilitado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
