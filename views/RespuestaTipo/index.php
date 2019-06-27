<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RespuestaTipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Respuesta';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="respuestatipo-index reglamento-container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Tipo de Respuesta', ['create'], ['class' => 'btn btn-default']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRespTipo',
            'respTipoDescripcion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>


</div>
