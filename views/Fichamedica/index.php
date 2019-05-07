<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FichamedicaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fichamedicas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fichamedica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fichamedica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idFichaMedica',
            'obraSocial',
            'peso',
            'altura',
            'frecuenciaCardiaca',
            //'idGrupoSanguineo',
            //'evaluacionMedica',
            //'intervencionQuirurgica',
            //'tomaMedicamentos',
            //'suplementos',
            //'observaciones',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
