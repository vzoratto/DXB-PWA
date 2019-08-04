<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

if (!empty($mensaje)) {
    $msg = $mensaje;
    
} else {
    $msg = "No se puede acceder a esta pagina";
}

$this->title = "Atencion!";
?>
<section id="cambiapass" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
    <div class="box-bd no-label" align="center">
        <img src="assets/img/logo-color.png" alt="logo color" style="max-width:150px">
        <div class="site-error" align="center">
           <h1><?= Html::encode($this->title) ?></h1>
           <div class="alert alert-danger">
               <?php echo nl2br(Html::encode($msg));?>
           </div>
           <div class="alert alert-info">
              <?php echo "Administracion: carreraxbarda@gmail.com";?>
           </div>
        </div>   
    </div>
</section>