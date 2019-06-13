<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GestoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrativos';
$this->params['breadcrumbs'][] = ['label' => 'Admin', 'url' => ['administrar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gestores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Administrativos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idGestor',
            'nombreGestor',
            'apellidoGestor',
            'telefonoGestor',
            //'idUsuario',
            [ 
                'attribute' => 'idUsuario',
                 'value' => function($model) {
                     return ($model->usuario->dniUsuario);
                 },
                 'filter' => ArrayHelper::map(Usuario::find()->where('idRol=2')->orWhere('idRol=3')->asArray()->all(), 'idUsuario', 'dniUsuario'),
               ],
               [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [],
                'header'=>'Actions',
                'template' => '{view}',
                
                ]
        ],
    ]); ?>


</div>
