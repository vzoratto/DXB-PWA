<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariorol */

$this->title = $model->idRol;
$this->params['breadcrumbs'][] = ['label' => 'Usuariorols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuariorol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idRol' => $model->idRol, 'idUsuario' => $model->idUsuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idRol' => $model->idRol, 'idUsuario' => $model->idUsuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idRol',
            'idUsuario',
        ],
    ]) ?>

</div>
