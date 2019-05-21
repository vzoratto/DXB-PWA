<?php
use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;
$this->title = 'Formulario de inscripcion';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="inscripciones-index">
    <!-- comienzo del formulario, se define el metodo de envio de datos y se llama a la accion "store" o guardar-->
    <?php $form = ActiveForm::begin([
        'method'=>'post',
        "action"=>"index.php?r=inscripcion%2Fstore"
    ]); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- utilizacion de un widget de jui llamado Tabs, se define cada una de las tabs 
    y dentro de ellas se renderiza su correspondiente vista a las cuales se le envian los 
    modelos correspondientes --> 
    <?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Datos Personales',
            'content' =>$this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form,'talleRemera'=>$talleRemera,'listadoTalles'=>$listadoTalles]),
        ],
        [
            'label' => 'Datos de contacto',
            'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form, 'datos'=>$datos]),

        ],
        [
            'label' => 'Datos medicos',
            'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
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
    'itemOptions' => ['tag' => 'div', 'class' => 'ui-tabs-panel'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);

     ActiveForm::end(); ?>

</div>