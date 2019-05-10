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
            'content' =>$this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario]),
        ],
        [
            'label' => 'Datos de contacto',
            'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona]),

        ],
        [
            'label' => 'Datos medicos',
            'content' => $this->render('datosmedicos',['fichaMedica'=>$fichaMedica]),
        ],
        [
            'label' => 'Contacto de emergencia',
            'content' => $this->render('contactoemergencia',['datosEmergencia'=>$datosEmergencia]),
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