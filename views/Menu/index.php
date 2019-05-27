<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Gestor ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Inscribir Corredor', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Exportar', ['excel'], ['class' => 'btn btn-primary']) ?>
    <?php echo "Filtrar por" ?>
        <?=Html::dropDownList('modelfield', null, ['1' => 'Todos los corredores',
            '2' => 'Capitanes',
            '3' => 'Equipos',
            '4' => 'Donadores',
            '5' => 'Participantes sin Abonar',
            '6' => 'Participantes que Abonaron'
                ], ['class' => 'form-control-md push-rigth', 'prompt' => '', 'options' =>
            [1 => ['Selected' => 'selected']]]);
        ?>
    
</p>
<h4>Buscar por </h4>
<?= "Nombre <br>" ?>
<?= Html::input('text', 'username') ?>
<?= "Apellido " ?>
<?= Html::input('text', 'username') ?>
<?= "DNI " ?>
<?= Html::input('text', 'username') ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idPersona',
            ['attribute'=>'idTalleRemera',
                'value'=> function($model){
              return ($model->talleRemera->talleRemera);
            }],
            'dniCapitan',
            'nombrePersona',
            'apellidoPersona',
            //'fechaNacPersona',
            //'sexoPersona',
            //'nacionalidadPersona',
            //'telefonoPersona',
            //'mailPersona',
            //'idUsuario',
            //'idPersonaDireccion',
            //'idFichaMedica',
            //'fechaInscPersona',
            //'idPersonaEmergencia',
            //'idResultado',
            //'donador',
            //'deshabilitado',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
