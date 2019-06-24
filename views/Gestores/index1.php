<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
use app\models\Rol;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GestoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
if($rol=='admin'){
    $this->title = 'Administrador';
}elseif($rol=='gest'){
    $this->title = 'Gestor';
}   
?>
<div class="gestores-index1">
<h4>Permisos otorgados para el rol <?= Html::encode($this->title) ?></h4>

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'idGestor',
            'Nombre',
            'Apellido',
            'DNI',
            'Email',
            'Telefono',
            'Rol',
              
             
        ],
    ]); ?>


</div>
