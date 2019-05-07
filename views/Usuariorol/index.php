<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariorolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuariorols';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariorol-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Usuariorol', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRol',
            'idUsuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
