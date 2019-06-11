<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

$this->title = $model->idTipoCarrera;
$this->params['breadcrumbs'][] = ['label' => 'Carrerapersonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="carrerapersona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idTipoCarrera' => $model->idTipoCarrera, 'idPersona' => $model->idPersona], [
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
            'idTipoCarrera',
            'idPersona',
            'reglamentoAceptado',
            'retiraKit',
        ],
    ]) ?>

</div>
