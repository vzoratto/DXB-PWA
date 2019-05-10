<?php
use yii\helpers\Html;
use yii\jui\Tabs;
$this->title = 'Formulario de inscripcion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscripciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Datos Personales',
            'content' => $this->render('datospersonales', [
                'model' => $model,
            ]) ,
        ],
        [
            'label' => 'Datos de contacto',
            'content' => '',

        ],
        [
            'label' => 'Datos medicos',
            'content' => '',
        ],
        [
            'label' => 'Contacto de emergencia',
            'content' => '',
        ],
        [
            'label' => 'Encuesta',
            'content' => '',
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);

?>
</div>