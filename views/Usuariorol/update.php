<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariorol */

$this->title = 'Update Usuariorol: ' . $model->idRol;
$this->params['breadcrumbs'][] = ['label' => 'Usuariorols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRol, 'url' => ['view', 'idRol' => $model->idRol, 'idUsuario' => $model->idUsuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuariorol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
