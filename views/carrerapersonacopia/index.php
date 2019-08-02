<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarrerapersonacopiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carrerapersonacopias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrerapersonacopia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Carrerapersonacopia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTipoCarrera',
            'idPersona',
            'reglamentoAceptado',
            'retiraKit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
