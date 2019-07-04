<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaTriviaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estadopagoequipos';

?>
<div class="respuesta-trivia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Respuesta Trivia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRespTrivia',
            'respTriviaValor',
            'idPregunta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
