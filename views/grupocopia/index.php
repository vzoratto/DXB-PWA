<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrupocopiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupocopias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupocopia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Grupocopia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idEquipo',
            'idPersona',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
