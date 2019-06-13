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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
              ],
           [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => [],
            'header'=>'Actions',
            'template' => '{view}',
            
            ]
          ],
        
    ]); ?>


</div>
