<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\models\Usuario;
use app\models\Permiso;

if (!empty($mensaje)) {
    $msg = $mensaje;
    
} else {
    $msg = "No se puede acceder a esta pagina";
   // $usurio=Usuario::findOne(['idisuario'=>$_SESSION['__id']]);

}

$this->title = "Atencion!";
?>
<section id="cambiapass" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
     <div class="jumbotron box-bd1">
          <img src="../web/assets/img/logo-color.png" alt="logo-color" class="mb-20" style="max-width:150px;"> 
        <div class="site-error" align="center">
           <h1><?= Html::encode($this->title) ?></h1>
           <div class="alert alert-danger">
               <?php echo nl2br(Html::encode($msg));?>
           </div>
           <div class="alert alert-info">
              <?php echo "Administracion: carreraxbarda@gmail.com";?>
           </div>
           <?Php if(Permiso::requerirRol('administrador')){
                    echo Html::a('Volver a admin', ['/site/admin'], ['class'=>'btn btn-chico btn-rounded btn-carrera submitbutton width-100']);         
          
                }elseif(Permiso::requerirRol('gestor')){
                    echo Html::a('Volver a gestor', ['/site/gestor'], ['class'=>'btn btn-chico btn-rounded btn-carrera submitbutton width-100']);
                }
                ?>
        </div>   
    </div>
</section>