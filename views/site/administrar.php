<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\jui\Tabs;
use buttflattery\formwizard\FormWizard;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Usuario;
use app\models\Rol;
use app\models\Gestores;

$usu="";$nombre="";
$rol="";
if (!Yii::$app->user->isGuest) {
    $usu =Usuario::findOne($_SESSION['__id']);
    $rol=Rol::find()->where(['idRol'=>$usu->idRol])->One();
    $nombre =Gestores::find()->where(['idUsuario'=>$usu->idUsuario])->One();
    
}else {
    $msg = "No se puede acceder a esta pagina";
}
$this->title = "Menu administrativo";
$this->params['breadcrumbs'][] = $this->title;
 ?>
 <?php ?>
 <div class="col-md-9 col-md-offset-2">
<div class="form-group col-md-6" align="left">
    <h2><?= "Hola  " .$nombre->nombreGestor ?></h2>
</div>
<div class="form-group col-md-6" align="right">
    <h2><?= "Rol administrativo:  " .$rol->descripcionRol ?></h2>
</div>
</div>
    <div class="col-md-6 col-md-offset-4">
    <h3><?=$this->title  ?></h3>
    </div>
    <?php
$wizard_config = [
	'id' => 'stepwizard',
	'steps' => [
		1 => [
            'title' => 'Datos Personales',
            'type'=>FormWizard::STEP_TYPE_TABULAR,
            'icon' => 'glyphicon glyphicon-user',
            'content'=>'',
			//'content' => $this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form,'talleRemera'=>$talleRemera,'listadoTalles'=>$listadoTalles,'equipoLista'=>$equipoLista,'equipo'=>$equipo,'elEquipo'=>$elEquipo,'tipoCarrera'=>$tipoCarrera,'tipocarreraLista'=>$tipocarreraLista,'cantCorredores'=>$cantCorredores,'swicht'=>$swicht]),
			'buttons' => [
                'next' => [
					'title' => 'Siguiente',
			 ],
		],	],
		2 => [
            'title' => 'Datos de contacto',
            'type'=>FormWizard::STEP_TYPE_TABULAR,
            'icon' => 'glyphicon glyphicon-envelope',
            'content'=>'',
			//'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form, 'datos'=>$datos]),
			'buttons' => [
                'next' => [
                    'title' => 'Siguiente',
				],
				'previous' => [
					'title' => 'Atras',
				]
            ],
		],
		3 => [
            'title' => 'Datos medicos',
            'type'=>FormWizard::STEP_TYPE_TABULAR,
            'icon' => ' glyphicon glyphicon-plus',
            'content'=>'',
			//'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
			'buttons' => [
                'next' => [
                    'title' => 'Siguiente',
				],
				'previous' => [
					'title' => 'Atras',
				]
            ],
        ],
    ],

'start_step' => 1, // Optional, start with a specific step
];
?>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>



    <div class="col-md-6 col-md-offset-3">

        
                <div class="form-group">
                    <div class="col-md-12 col-offset-1">
                        <h4 class="col-md-12">-----><a href="index.php?r=menu/index">Gestion datos participante</a></h4>
                        <h4 class="col-md-12">-----><a href="index.php?r=usuario/index">Gestion datos invitados</a></h4>
                        <h4 class="col-md-12">-----><a href="index.php?r=usuario/index">Gestion datos personas usuario</a></h4>
                        <h4 class="col-md-12">-----><a href="index.php?r=gestores/index">Gestion datos personas administrativas</a></h4>
                        <h4 class="col-md-12">-----><a href="index.php?r=remeras/index">Gestion datos entrega remeras</a></h4>
                        <h4 class="col-md-12">-----><a href="">xxxx</a></h4>
                        <h4 class="col-md-12">-----><a href="">xxxxx</a></h4>
                        <h4 class="col-md-12">-----><a href="">xxxxxx</a></h4>
                        <h4 class="col-md-12">-----><a href="">xxxxx</a></h4>
                    </div>
                </div>
      </div>
    </div>

 





