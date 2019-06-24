<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Corredor';

?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <h3><?= Html::encode($mensaje) ?></h3>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [  'label'=>'Referencia',
                'attribute'=>'idPersona',
           ],
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
                'filter' => ArrayHelper::map(Usuario::find()->asArray()->all(), 'idUsuario', 'dniUsuario'),
                
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
