<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResultadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resultados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resultado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resultado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idResultado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
