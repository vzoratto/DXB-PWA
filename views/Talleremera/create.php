<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Talleremera */

$this->title = 'Create Talleremera';
$this->params['breadcrumbs'][] = ['label' => 'Talleremeras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="talleremera-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
