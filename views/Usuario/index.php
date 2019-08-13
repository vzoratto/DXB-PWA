<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Usuario;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
?>
<div class="usuario-index reglamento-container">

    <div class="row mtb-20">

      <div class="col-xs-6 col-md-6 p-0">

        <h1 class="m-0"><?= Html::encode($this->title) ?></h1>

      </div>

      <div class="col-xs-6 col-md-6">

        <?= Html::a('Usuario +', ['create'], ['class' => 'btn btn-success']) ?>

      </div>

    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
            'header' => '#',
            'headerOptions' => ['style' => 'color:#337ab7'],
        ],

            //'idUsuario',
            'dniUsuario',
            //'claveUsuario',
            'mailUsuario',
           // 'authkey',
            //'activado',

             [ 'label'=>'Rol',
               'attribute' => 'idRol',
                'value' => function($model) {
                    return ($model->rol->descripcionRol);
                },
                'filter' => ArrayHelper::map(Rol::find()->asArray()->all(), 'idRol', 'descripcionRol'),
                'filterInputOptions' => ['prompt' => 'Elije ...', 'class' => 'form-control', 'id' => null]
              ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],

                ],

          ],

    ]); ?>


</div>
