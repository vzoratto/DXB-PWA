<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carrerapersona */

$this->title = 'Create Carrerapersona';
$this->params['breadcrumbs'][] = ['label' => 'Carrerapersonas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrerapersona-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
