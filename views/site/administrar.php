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
/* @var $this yii\web\View */

$this->title = 'Area Administrativa';

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

 ?>
<div class="site-administar">

        <div class="jumbotron">
          <img src="../web/assets/img/logo-color.png" alt="logo-color" class="mb-20" style="max-width:150px;">
            <h1>Hola <?= $nombre->nombreGestor ?></h1>
            <h4><?= "Rol :  " .$rol->descripcionRol ?></h4>
               <p class="lead">Que tengas un buen dia!</p>

        </div>
    <div class="body-content">


    </div>

</div>
