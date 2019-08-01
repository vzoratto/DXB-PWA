<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FechacarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fechacarreras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fechacarrera-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fechacarrera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idFechaCarrera',
            'fechaCarrera',
            'fechaLimiteUno',
            'fechaLimiteDos',
            'deshabilitado',
            //'idTipoCarrera',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
