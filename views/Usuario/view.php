<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Usuario;
/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Usuario: '.$model->idUsuario;

\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
          $descRol=Usuario::findIdentity($_SESSION['__id']);
           if($descRol->idRol==2){
              echo  Html::a('Actualizar', ['update', 'id' => $model->idUsuario], ['class' => 'btn btn-primary']); 
              echo  Html::a('Eliminar', ['delete', 'id' => $model->idUsuario], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro que quiere eliminar este registro???',
                    'method' => 'post',
                ],
            ]);     
            }
	    ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idUsuario',
            'dniUsuario',
            //'claveUsuario',
            'mailUsuario',
           //'authkey',
            //'activado',
            ['attribute'=>'idRol',
            'value'=>function($model){
                return($model->rol->descripcionRol);
            }
          ],
        ],
    ]) ?>

</div>
