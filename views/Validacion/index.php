<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ValidacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Validacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="validacion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Validacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idValidacion',
            'idUsuario',
            'mailUsuarioValidado',
            'codigoValidacionMail',
            'codigoRecuperarCuenta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
