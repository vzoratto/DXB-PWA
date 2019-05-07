<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaemergenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personaemergencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personaemergencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Personaemergencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idPersonaEmergencia',
            'nombrePersonaEmergencia',
            'apellidoPersonaEmergencia',
            'telefonoPersonaEmergencia',
            'idVinculoPersonaEmergencia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
