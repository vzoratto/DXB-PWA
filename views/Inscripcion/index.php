<?php
use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;
$this->title = 'Formulario de inscripcion';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inscripciones-index">

    <?php $form = ActiveForm::begin([
        'method'=>'post',
        "action"=>"index.php?r=inscripcion%2Fstore"
    ]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Datos Personales',
            'content' =>$this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form]),
        ],
        [
            'label' => 'Datos de contacto',
            'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form]),

        ],
        [
            'label' => 'Datos medicos',
            'content' => $this->render('datosmedicos',['fichaMedica'=>$fichaMedica,'form'=>$form]),
        ],
        [
            'label' => 'Contacto de emergencia',
            'content' => $this->render('contactoemergencia',['datosEmergencia'=>$datosEmergencia,'form'=>$form]),
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
     ActiveForm::end();

?>
</div>