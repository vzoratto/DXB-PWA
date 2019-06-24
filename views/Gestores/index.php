<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GestoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado administrador/gestor';

?>
<div class="gestores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'idGestor',
            'nombreGestor',
            'apellidoGestor',
            'telefonoGestor',
              [ 
                'attribute' => 'idUsuario',
                 'value' => function($model) {
                     return ($model->usuario->dniUsuario);
                 }
                 //'filter' => ArrayHelper::map(Usuario::find()->where('idRol=2')->orWhere('idRol=3')->asArray()->all(), 'idUsuario', 'dniUsuario'),
               ],
               [
               'attribute' => 'rol',
               'value' => function($model) {
                   return ($model->usuario->rol->descripcionRol);
                   }
               ],
               [
                'attribute' => 'email',
                'value' => function($model) {
                    return ($model->usuario->mailUsuario);
                    }
                ],
               ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
