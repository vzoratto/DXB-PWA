<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuariorol */

$this->title = 'Create Usuariorol';
$this->params['breadcrumbs'][] = ['label' => 'Usuariorols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuariorol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
